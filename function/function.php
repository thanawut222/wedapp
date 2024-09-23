<?php

					//============== Function ??????????????? ==============
					function insert($field,$value,$table)
							{
									$sql = "INSERT INTO $table ($field) VaLUES ($value)";
									//echo $sql;
									$result= mysqli_query($sql);
									return $result;
							}
							
					//============== Function ????????????? ==============
					function delete($table,$condition)
							{
								$sql ="delete from $table $condition";
								$result = mysqli_query($sql);
								return $result;
							}
							
					//=============== Function ???????????????? ==================
					function update($table,$command,$condition)
							{
									$sql = "UPDaTE $table SET $command $condition";
									$result = mysqli_query($sql);
									return $result;
							}
							
					//=============== Function ???????????????? ==================		
							function select($table,$condition)
							{
				
										$sql = "select * from $table $condition";
										//echo $sql;
										$dbquery = mysqli_query($sql);
										$result= mysqli_fetch_array($dbquery);
										return $result;
							}

					//=============== Function ?????????????????????? ==================	
							 function selectalldate($table,$condition,$listby)
						  {
									$sql = "select * from $table $condition $listby";
									//echo $sql;
									$dbquery = mysqli_query($sql);
									return $dbquery;	
						  }
									
							//=============== select  Reccord Max or Min==================	// ????????????? ?? ??????????	 ?????????? ??????
							function selectMaxOrMin($maxormin,$field,$table,$condition)
							{
							
										$sql = "select $maxormin($field) as $field from $table $condition";
										$dbquery = mysqli_query($sql);
										$result= mysqli_fetch_array($dbquery);
										return $result;
							}
							
							//=============== Function ????????????????==================		
							function selectFistOrLast($table,$condition,$fieldlist,$bylist)
							{
							
										$sql = "select * from $table $condition order by $fieldlist $bylist";
										$dbquery = mysqli_query($sql);
										$result= mysqli_fetch_array($dbquery);
										return $result;
							}
							
							//=============== Function ????????????????????????? ==================
							function checkcharector($temp)
							{
							$temp=Trim(eregi_replace ( "'" , "" , $temp));
							$temp=Trim(eregi_replace ( "\"" , "&quot;" , $temp));
							return $temp;
							}
																				
							//=============== Function ??????????????? ==================		
							function num_record($table,$condition)
							{
						
										$sql = "select * from $table $condition";
										$dbquery = mysqli_query($sql);
										$num_rows = mysqli_num_rows($dbquery);
										return $num_rows;
							}
							
						//=============== Function ????????????????????? ==================		
										function JscheckValueNull($form,$field,$msg)
										{
										echo"\nif(trim(document.$form.$field.value)=='')\n";
										echo"{\n";
										echo"alert('$msg');\n";
										echo"document.$form.$field.focus();\n";
										echo"return false;\n";
										echo"}\n\n";
										}
				
?>