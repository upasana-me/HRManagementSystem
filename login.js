function validateForm()
{
    var elements = document.forms["form"].elements;
    for( i in elements )
	{
	    var value = i.value;
	    if( value == null || value == "")
		{
		    alert("All fields need to be filled.");
		    return false;
		}
	}

}

