<?php
session_start();
include_once("Classes/Request.php");
include_once ("Classes/customers.php");
include_once ("Classes/Personnes.php");
include_once ("Classes/Shamgar.php");
include_once ("Classes/CAAI.php");
include_once ("Classes/Air_Force.php");
$Id = $_GET["idRequest"];
$request = Request::getRequestOnId($Id);
$user = unserialize($_SESSION["User"]);

if (!(isset($_SESSION["Connected"]) && $_SESSION["Connected"])) {
    header("Location:IndexLoginPages.php");
}
require_once('Classes/Types.php');
require_once('Classes/customers.php');
if (isset($_SESSION["User"])) {
    $user = unserialize($_SESSION["User"]);
}
$readOnly = "";
$readOnlyAirforce ="readonly";
if($user->getTypes() == "custommer" || $user->getTypes() == "Shmgar")
{
    $readOnly = "";
    $disable = "";
    $actionRemove = "onclick=\"RemoveRow(this)\"";
}
else
{
    $readOnly = "readonly";
    $disable = "disabled";
    $actionRemove = "";
}
if($user->getTypes() == "Air_Force")
{
    $readOnlyAirforce ="";
}
?>
<head>
    <title> הצד של הלקוח </title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- עיצוב לתיבת בחירה תאריך -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>

    <!--  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->


</head>



<form  method="post" action="UpdateRequest.php" charset="utf-8" enctype="multipart/form-data" dir="rtl" id="Form" align="right">
                 <Label>request Id</Label><input   type="number" readonly name="FormID" value="<?=$request->getID()?>">
                 <br/>
                 <Label>Client Id</Label><input type="text" readonly name="ClientID" value="<?=$request->getIDclient()?>">
                 <p> בס"ד  </p>
                 <table border="1" cellpadding= "0" align="center" width="569" >
                     <tr><td > ANS Handbook</td> <td rowspan="3" align="center"> <img width="96" height="58" src="images/rata.jpg"/> </td> <td > ANS 4.7.004-1</td></tr>
                     <tr> <td > Revision #0 </td> <td rowspan="2" width= "200"> טופס בקשה להתייחסות חיל אוויר לביצוע טיסה אזרחית חריגה</td></tr>
                     <tr><td > 26 FEB 2014</td></tr>
                 </table>
                 <p align="center" dir="RTL"> (סימוכין: בקשה לטיסה חריגה לפי פרק א-11 סעיף י' ולפי פרק א-17בפמ"ת)   </p>
                 <p>שם המבקש (מפקח רת"א)</p>
                 <p> :תאריך הגשת הבקשה <?=$request->getDates();?></p>
                 <p>
                     <!-- here start the form-->
                     <label dir="RTL" > 1. פרטי הגוף המבצע </label>
                 <ol align="right" dir="RTL">
                     <div class="form-group" >
                         א. שם החברה / הטייס / אגודה מובילה :<input type="text" <?= $readOnly ?> name="Company_name" value="<?=$request->getCompanyName()?>" class="form-control" required>
                     </div>
                     <div class="form-group" dir="RTL">
                         ב. כלי הטיס המבצע/ים:<input type="text" name="Operational_pilots" <?= $readOnly ?> value="<?=$request->getOperationalPilots()?>" class="form-control" required>
                     </div>
                     <div class="form-group">
                         ג. אמצעי קשר קיימים בטיסה:<input type="text" <?= $readOnly ?> name="Flight_communication" value="<?=$request->getFlightCommunication()?>" class="form-control" required>
                     </div>
                     <div class="form-group">
                         ד. ציוד הצילום (במידה ורלונטי) פירוט מלא:<input type="text" <?= $readOnly ?> name="Photography_equipment" value="<?=$request->getPhotographyEquipement()?>" class="form-control" required>
                     </div>
                 </ol></p>
                 <p> <ol>
                     <label dir="RTL"> 2. תכלית הטיסה </label>
                     <ol align="right" dir="RTL">
                         <div class="form-group">
                             א. הסבר על מהות הטיסה, אזור עבודה ואופן הביצוע.:<input <?= $readOnly ?> type="text" name="ENOTF" value="<?=$request->getENOTF()?>" class="form-control" required>
                         </div>
                         <div class="form-group">
                             ב. טיסה מזדמנת או שוהה:
                             <div class="form-check-inline">
                                 <label class="form-check-label">
                                     <input type="radio" name="COSF" <?= $readOnly == "readonly" ? "disabled" : "" ?> <?= $request->getCOSF() == "Casual" ? "checked" : ""?>  value="Casual"  class="form-control" required >מזדמנת
                                 </label>
                             </div>
                             <div class="form-check-inline">
                                 <label class="form-check-label">
                                     <input type="radio" name="COSF" <?= $readOnly == "readonly" ? "disabled" : "" ?> <?= $request->getCOSF() == "staying" ? "checked" : ""?> value="staying"  class="form-control" required>שוהה
                                 </label>
                             </div>
                         </div></ol>
                 </ol> </p>
                 <p >
                     <label dir="RTL"> 3. מהות החריגה </label>
                 <ol align="right" dir="RTL">
                     <div class="form-group">
                         א. פירוט מהות החריגה מהפמ"ת או מהנחיות תעבורה אווירית.:<input <?= $readOnly ?> type="text" name="ENOTF" value="<?=$request->getENOTF()?>"  class="form-control" required>
                     </div> </ol></ol></p>
                 <p ><ol>
                     <label dir="RTL"> 4.נתיב הטיסה  </label>
                     <ol align="right" dir="RTL">
                         <div class="form-group"> א. כיווני טיסה :<input <?= $readOnly ?> type="text" name="Flight_directions" value="<?=$request->getFlightCommunication()?>"  class="form-control" required>
                         </div>
                         <div> ב. מסלול טיסה : </div>
                     </ol>
                     <ol align="right" dir="RTL">
                     </ol></p>
                 <h3 class="text-center text-info"> : הוספת טבלה מסלול טיסה</h3><input  type="button" <?= $readOnly== "readonly" ? "" : "onclick=\"addARow()\"" ?>  id="addRow" value="+"></input>
                 <script>
                         function giveTheNumberOfRow()
                         {
                             var number = $(".number");
                             var MaxNumber =0,temp;
                             for (let i=0;i < number.length;++i)
                             {
                                 temp = number[i].innerText || number[i].textContent;
                                 temp = parseInt(temp);
                                 MaxNumber = temp > MaxNumber ? temp:MaxNumber;
                             }
                             return MaxNumber;
                         }
                         function RemoveRow(e)
                         {
                             console.log(e);
                            var elementToRemove = e.parentNode.parentNode;
                            console.log(elementToRemove)
                            $(elementToRemove).remove();
                            var number = $(".number");
                            for (let i=0;i < number.length;++i)
                            {
                                number[i].innerText = i+1;
                            }
                         }
                         function addARow()
                         {
                                var number = giveTheNumberOfRow() +1;
                                console.log(number);
                                $("#dataTable").append(`<TR>
                                            <TD><INPUT type="button" id="removeRow" onclick="RemoveRow(this)"  name="chk" value="-"/></TD>
                                     <TD class="number">`+ number.toString() +`</TD>
                                     <TD > <div class="form-group"> נקודת התחלה: <INPUT type="text" name="start_point[]"  class="form-control" required /> </TD></div>
                                     <TD > <div class="form-group"> נקודת סיום : <INPUT type="text" name="end_point[]"  class="form-control" required /> </TD></div>
                                     <TD style="word-wrap: break-word;max-width: 150px;" > <div class="form-group"> גובה במסלול זה :<INPUT type="text" name="Track_height"  class="form-control" required /> </TD></div>
                                     <TD>
                                     <div class="form-group">
                                     <input type="hidden" name="oldimage">
                                     <input type="file" name="image[]"  class="custom-fle" accept="image/gif, image/jpeg, image/png">
                                     </div>
                                     </TD>
                                     </TR>`)
                         }
                 </script>
                 <TABLE class="panelgrid" rules="all" border="1" id="dataTable"  dir="rtl" style="background-color:#f2f2f2;margin:auto;border: 3px solid #73AD21;">
                    <?php
                        for ($i=0;$i<count($request->getArrayStartPoint());$i++ )
                        {
                            echo "<TR>
                         <TD><INPUT ". $readOnly ." type=\"button\" id=\"removeRow\" ".$actionRemove."  name=\"chk\" value=\"-\"/></TD>
                         <TD class=\"number\"> 1 </TD>
                         <TD > <div class=\"form-group\"> נקודת התחלה: <INPUT ". $readOnly . " type=\"text\" value='".$request->getArrayStartPoint()[$i]."' name=\"start_point[]\"  class=\"form-control\" required /> </TD></div>
                         <TD > <div class=\"form-group\"> נקודת סיום : <INPUT  ". $readOnly . " type=\"text\" name=\"end_point[]\" value='".$request->getArrayEndPoint()[$i]."'  class=\"form-control\" required /> </TD></div>
                         <TD style=\"word-wrap: break-word;max-width: 150px;\" > <div class=\"form-group\"> גובה במסלול זה :<INPUT ". $readOnly . " type=\"text\" value='".$request->getArraytrackHeight()[$i]."' name=\"Track_height[]\" class=\"form-control\" required /> </TD></div>
                         <TD>
                         <div class=\"form-group\">
                                <input type=\"hidden\" name=\"oldimage\">
                                <input ".$disable." type=\"file\" name=\"image[]\" value='0' class=\"custom-fle\" accept=\"image/gif, image/jpeg, image/png\">
                                <img src=\"Upload/". $request->getArrayImage()[$i] ."\"/>
                         </div>
                         </TD>
                         </TR>";
                        }
                 ?>
                 </TABLE>
                    <p align="center" dir="RTL"> * נקודות ציון ברשת WGS84 בפורמט DMS.</p>
                    </ol>
                    <br>

                    <p dir= "rtl" > 5.זמני ביצוע</p>

                    <div class="form-group"dir="RTL" >  א. פירוט תאריכים ושעות. <br>
                        תאריך התחלה  :<input type="date" <?= $readOnly ?> value="<?=$request->getDateStart()?>"  name="DateStart" placeholder="Datum" class="datePickerPlaceHolder"/> תאריך סיום :<input <?= $readOnly ?> type="date" placeholder="Choose a Date" name="DateEnd" value="<?=$request->getDateEnd()?>" /><br><br>
                        שעת התחלה :<input type='time' <?= $readOnly ?> value="<?=$request->getHourStart()?>" id='myTime' name="HourStart"/> שעת סיום :<input <?= $readOnly ?> value="<?=$request->getHourEnd()?>" type='time' id='myTime' name="HourEnd"/>
                    </div>
                    <br>
                    <p dir= "rtl" > 6.   מידע מסייע נוסף  </p>
                    <div class="form-group"dir="RTL" >
                        א. באם קיים מידע מסייע להבנת מתאר הטיסה יש לפרט על כך: <input <?= $readOnly ?> type="text" name="Explain_the_nature_of_the_flight"  value="<?=$request->getENOTF()?>" class="form-control" required>
                        <!--<input type="text" name="fname" onkeypress="this.style.minWidth = ((this.value.length + 1) * 7) + 'px';>-->
                    </div>


                    <br>

                    <p align="center-left" dir ="rtl">בברכה, רשות התעופה האזרחית.</p>

                    <br>
                    <br>
                    <hr />
                    <table border="1" cellpadding= "0" align="center" width="569" >
                        <caption></caption>
                        <tr><td > ANS Handbook</td> <td rowspan="3" align="center"> <img width="96" height="58" src="images/rata.jpg"/> </td> <td > ANS 4.7.004-1</td></tr>
                        <tr> <td > Revision #0 </td> <td rowspan="2" width= "200"> טופס בקשה להתייחסות חיל אוויר לביצוע טיסה אזרחית חריגה</td></tr>
                        <tr><td > 26 FEB 2014</td></tr>
                    </table>
             </div>
    <input type="text" class="col-6" style="height:10vh;" name="Texte" value="<?=$request->getTexte()?>"/>
            <div class="row">
                    <?php if($request->getHasCAAIsign())
                    {
                        echo '<img src="Signature/CAAIimages.png" />';
                        echo '<p>Date:'.$request->getDateCAAIsign().'</p>';
                        echo '</div><div class="row">';
                    }?>
                </div>
                <div class="col">
                    <?php if($request->getHasShmSign())
                    {
                        echo '<img src="Signature/shamgarimages.png" />';
                        echo '<p>Date:'.$request->getDateShmsign().'</p>';
                        echo '</div><div class="row">';
                    }?>
                </div>
            </div>
    <div id ="Air_Force" dir="rtl" align="right" >
        <p> <big> <u> <strong> תשובת חיל אוויר </strong> </u> </big> </p>
        <br>
        <P dir="rtl" align="right"> שם ותפקיד המתייחס:<input type="text" name="Name_and_role" value="<?=$request->getNameAndRole() ?>" <?=$readOnlyAirforce?> ></p>
        <P dir="rtl" align="right"> תאריך התייחסות: <?=date("Y/m/d");?></p>
        <br>
        סמן האם ישנה הסתייגות או אין הסתייגות מביצוע הטיסה :<br>
        <input type="radio" onclick="document.getElementById('ifYes').style.display = 'block';document.getElementById('ifNo').style.display = 'none';<?= $user->getTypes() == 'Air_Force'?'':'return false;'?>"
            <?= $request->getHaAirforceSign() ? "":"checked" ?> <?=$readOnlyAirforce?> value="no"  name="yesno" id="yesCheck"/>
        <label for="yesCheck">אין אנו מסתייגים מביצוע הטיסה </label><br>
        <div id="ifYes" <?= $request->getHaAirforceSign() ? "style=\"display:none\"":"" ?>>
            בהתניות הבאות: <br> <input type="text"   <?=$readOnlyAirforce?>  name="detailrefused" value="<?=$request->getAirForceReason()?>" class="form-control" />
        </div>
        <input type="radio"  <?= $request->getHaAirforceSign() ? "checked":"" ?> onclick="document.getElementById('ifNo').style.display = 'block';document.getElementById('ifYes').style.display = 'none';<?= $user->getTypes() == 'Air_Force'?'':'return false;'?>"
            <?=$readOnlyAirforce?>  name="yesno" value="yes" id="noCheck"/>
        <label for="noCheck">אנו מסתייגים מביצוע טיסה זו </label><br>
        <div id="ifNo" <?= $request->getHaAirforceSign() ? "":"style=\"display:none\"" ?>>
            מהסיבות הבאות : <br> <input type="text" name="detailAccepted" <?=$readOnlyAirforce?> value="<?=$request->getAirForceReason()?>" class="form-control" />
        </div>
        <br>
        <P>הערות נוספות:<br> <textarea <?=$readOnlyAirforce?>  name="Additional_Comments" rows="3" cols="100"><?=$request->getAdditionalCommentsAirforce()?></textarea> </p>
            <?php if($request->getHaAirforceSign())
            {
                echo '<div class="Row">';
                echo '<img src="Signature/AirForceimages.png" />';
                echo '<p>Date:'.$request->getDateAirForcesign().'</p>';
                echo '</div>';
            }?>
    </div>
    <div class="row">
        <div class="col">
    <input type="submit" class="btn boutonRemove btn-primary" value="SEND"/>
        </div>
        <div class="col">
            <?= $request->getHaAirforceSign() && $request->getHasShmSign() && $request->getHasCAAIsign() ? "<p onclick='Pdf();return false;' class=\"btn boutonRemove btn-primary\" id='PrintPdf'>Print To pdf</p>" : ""?>
        </div>
        <div class="col">
            <a href="Redirection.php" class="btn boutonRemove btn-primary">Back</a>
        </div>
    </div>
         </div>
        </div>
    </form>
</div>
?>
