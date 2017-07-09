/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openIconNav() {
    document.getElementById("mySideIconnav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeIconNav() {
    document.getElementById("mySideIconnav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

/*function for menu icon  */
function myIconFunction(x) {
	x.classList.toggle("change");
}

/**/
/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myTopHeadNav() {
    document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
}

// Get the sign up modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

/*image slide show */

var picPaths = ['images/shillong.jpg','images/kochi.jpg','images/ff78ff16dc25e5bb1b97f17a829761ac.jpg','images/Affordable-Bikes.jpg','images/lightColor.jpeg'];
	var curPic = -1;
	//preload the images for smooth animation
	var imgO = new Array();
	for(i=0; i < picPaths.length; i++) {
		imgO[i] = new Image();
		imgO[i].src = picPaths[i];
	}

	function swapImage() {
		curPic = (++curPic > picPaths.length-1)? 0 : curPic;
		imgCont.src = imgO[curPic].src;
		setTimeout(swapImage,2500);
	}

	window.onload=function() {
		imgCont = document.getElementById('imgBanner');
		swapImage();
	}

/* comment section start here */



/* end of comment section */

/* hide of comment section */
	$(document).ready(function() {
        $("#flip").click(function(){
			$("#panel").toggle("slow")
		});
    });

/* end of hide of comment section */


/***************************************************************************************************************
 * Here first of get the image if from displayImageWithButton function and store the value of that particular
 * image id in a javascript variable and call another function which is update the bikes table with the following
 * data (userid,bikeid, startdate and enddate)
 **************************************************************************************************************/
	function passImageId(intvalue,startdate,enddate) {
  	var xhttp;
  	var val = intvalue;
    var sdate = startdate;
    var edate = enddate;
		// console.log("val is : " ,intvalue);
    // console.log("start date is : " ,startdate);
    // console.log("end date is : " ,enddate);
    // var dataObj = new Object();
    // dataObj.imageid = val;
    // dataObj.fdate = sdate;
    // dataObj.ldate = edate;
    // console.log("selected data is : ",dataObj);

		if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
  	} else {
  		// code for IE6, IE5
  		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  	}
  	xmlhttp.onreadystatechange = function() {
  		if (this.readyState == 4 && this.status == 200) {
  			document.getElementById("txtHint").innerHTML = this.responseText;
  		}
  	};
	xmlhttp.open("GET","http://localhost/BIke-Rental-Revised/bootstrap-datetimepicker-master/sample in bootstrap v3/getuser.php?q="+ intvalue + "&startdate = " + startdate + " enddate = " + enddate
,true);
	xmlhttp.send();

}
/* end of passing the value of start date ,end date and image id */

/*chech date is valid or not */
function checkDate(){
	var date1 = (document.getElementById('startDate').value != "");
	var date2 = (document.getElementById('enddate').value != "");
	if(!date1 || !date2 ){
	alert("Please fill both date ");
	return false;
	}
	return true;
}

function EditFunction(){
	confirm("click ok to moove to login page ");
}
