<script type="text/javascript">
//Set up some variables to be used by the timer
var c=0;  //loop counter
var timer_is_on=0;  //timer status 0=off 1=on

//Timer functions
function timedCount(){ //when the timer is running this calls the loadXMLDoc() function every 1000mSecs
loadXMLDoc(); //each time this function is called the dynamic content is updated
c=c+1;  //this just keeps track of the number of times this function is called
if (timer_is_on)
	{
	setTimeout("timedCount()",1000);  //The setTimeout() method calls a function or 
										//evaluates an expression after a specified number
										//of milliseconds.
	}
}
	
function doTimer()  { //Start timer
if (!timer_is_on)
  {
  timer_is_on=1;
  timedCount();
  }
}

function stopTimer() { //Stop timer
	timer_is_on=0;
}

function loadXMLDoc(){ //Gets the specified URL and inserts content into the specified element(myContent)
//Set up some variables
//req: handle for the XMLHttpRequest request object
var req;

// urlToFetch: URL of the dynamic content 
// Note the randNum variable being added to make the request unique
// This is required to overcome caching at the browser
var urlToFetch = '<?php echo __THIS_URI_ROOT; //from the CONFIG/config.php file?>index.php?pageID=chat&&randNum=' + new Date().getTime();

//Create the appropriate XMLHttpRequest object for the browser being used: 
//The XMLHttpRequest object can be used to request data from a web server
try{// Opera 8.0+, Firefox, Safari   	
      req = new XMLHttpRequest();
	}
catch (e){// Internet Explorer Browsers - Backward compatibility		
		try
			{
			req = new ActiveXObject("Msxml2.XMLHTTP");
			}
		catch (e) 
			{
			try
				{
				req = new ActiveXObject("Microsoft.XMLHTTP");
				}
			catch (e)
				{
				//Something went wrong
				alert("Your browser does not support live updates");
				return false;
				}
			}
	}
 
req.open("GET",urlToFetch,true);  
//Note: open(method, url, async) 	Specifies the type of request
//	method: the type of request: GET or POST
//	url: the file location
//	async: true (asynchronous) or false (synchronous)

req.send(); //Sends an HTTP request to the server and receives a response.

req.onreadystatechange=function(){  // Action to be performed when the document is read
  if (req.readyState==4 && req.status==200)  //When readyState=4 and status=200 the response is ready
    {
	//document.getElementById("chat").innerHTML='urlToFetch = '+urlToFetch +'</br>'+ req.responseText;
        document.getElementById("chat").innerHTML=req.responseText;
    }
	//The following notes will help to understand the code
	//
	//Note:req.onreadystatechange: 
	//	The onreadystatechange event is triggered every time the readyState changes.
	//
	//
	//Note :req.readyState: 
	//	During a server request, the readyState changes from 0 to 4.
	// 	0:   The object has been created, but not initialized (the open method 
	//  	 has not been called).
	// 	1:   A request has been opened, but the send method has not been called. 
	// 	2:   The send method has been called. No data is available yet. 
	// 	3:   Some data has been received; however, neither responseText 
	//     	 nor responseBody is available. 
	// 	4:   All the data has been received. 
	//
	//Note :req.status
	// 	200: "OK"
	// 	404: Page not found
	//
	// 
  }


}
</script>