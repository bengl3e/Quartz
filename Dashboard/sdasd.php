<?php
	
	$b = array ("abcd@bu.edu", "pieman@aol.com", "diezombies52@pie.com");	

	
	echo ("\n");
	echo "<table border=\"1\" style=\"width:300px\">\n"; 
echo "  <tr>\n"; 
echo "  <th>Email</th>\n"; 
echo "  <th>Create</th>\n"; 
echo "  <th>Activate</th>\n";
echo "  <th>Version </th>\n";
echo "  <th>Contact </th>\n";
echo "  </tr>\n"; 
	
	for($i=0;$i<=count($b);$i++) { 
 echo ($i);
 echo "<td>" .$b[$i] . "</td> ";
 echo "<td> <form  action='' method='POST'>"; 
    echo "<input type='hidden' name='item' value='" . $i . "' />";
   echo "<input class='z' type='submit' name='delete'  value='delete'> </form>";
echo "</td>";
 echo "<li>" .$b[$i] . "</li> ";
   $p="remove" . $i ;
   echo ($p);
   echo "<form  action='' method='post'>";
   echo "<input type='hidden' name='item' value='" . $i . "' />";
   echo "<input class='z' type='submit' name='delete'  value='delete'> </form>";
 }
  if(isset($_POST['delete']))
{
   $item = $_POST['item'];
   //code for deleting $item
}
   ?>
