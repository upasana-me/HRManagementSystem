<?php
header('Content-type: text/javascript');
?> 

function validateForm()
{
  var x=document.forms["form"]["username"].value;
  if (x==null || x=="")
    {
      alert("Username must be filled out");
      return false;
    }

  x=document.forms["form"]["pwd"].value;
  if (x==null || x=="")
    {
      alert("Password must be filled out");
      return false;
    }
}

