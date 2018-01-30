INSTALLATION
============
This plugin add a Instant Search Form and generate RSS Feed for your site.

1. Upload and install plugin.

2. Copy the below snippet before </head> in your theme:

<script>
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","/bl-plugins/search/livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>

3. Copy the below snippet in your theme in the sidebar section:

<form>
<input type="text" size="10" onkeyup="showResult(this.value)" placeholder="Search...">
<div id="livesearch"></div>
</form>