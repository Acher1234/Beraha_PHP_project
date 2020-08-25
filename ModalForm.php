
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <form  method="post" action="CreateRequest.php" charset="utf-8" enctype="multipart/form-data" dir="rtl" align="right">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title text-align-right text-info" >שליחת בקשה חדשה</h4>
                </div>
         <input id="divFormContentContainer" class="formContent">
             <div id="AForm1_canvas" >
                 <input type="hidden" name="FormID" value="-1">
                 <input type="hidden" name="ClientID" >
                 <p> בס"ד  </p>
                 <table border="1" cellpadding= "0" align="center" width="569" >
                     <tr><td > ANS Handbook</td> <td rowspan="3" align="center"> <img width="96" height="58" src="images/rata.jpg"/> </td> <td > ANS 4.7.004-1</td></tr>
                     <tr> <td > Revision #0 </td> <td rowspan="2" width= "200"> טופס בקשה להתייחסות חיל אוויר לביצוע טיסה אזרחית חריגה</td></tr>
                     <tr><td > 26 FEB 2014</td></tr>
                 </table>
                 <p align="center" dir="RTL"> (סימוכין: בקשה לטיסה חריגה לפי פרק א-11 סעיף י' ולפי פרק א-17בפמ"ת)   </p>
                 <p>שם המבקש (מפקח רת"א)</p>
                 <p> :תאריך הגשת הבקשה <?=date("Y/m/d");?></p>
                 <p>
                     <!-- here start the form-->
                     <label dir="RTL" > 1. פרטי הגוף המבצע </label>
                 <ol align="right" dir="RTL">
                     <div class="form-group" >
                         א. שם החברה / הטייס / אגודה מובילה :<input type="text" name="Company_name" value="" class="form-control" required>
                     </div>
                     <div class="form-group" dir="RTL">
                         ב. כלי הטיס המבצע/ים:<input type="text" name="Operational_pilots" value="" class="form-control" required>
                     </div>
                     <div class="form-group">
                         ג. אמצעי קשר קיימים בטיסה:<input type="text" name="Flight_communication" value="" class="form-control" required>
                     </div>
                     <div class="form-group">
                         ד. ציוד הצילום (במידה ורלונטי) פירוט מלא:<input type="text" name="Photography_equipment" value="" class="form-control" required>
                     </div>
                 </ol></p>
                 <p> <ol>
                     <label dir="RTL"> 2. תכלית הטיסה </label>
                     <ol align="right" dir="RTL">
                         <div class="form-group">
                             א.
                             אזור עבודה ואופן הביצוע.:<input type="text" name="ENOTF" value="" class="form-control" required>
                         </div>
                         <div class="form-group">
                             ב. טיסה מזדמנת או שוהה:
                             <div class="form-check-inline">
                                 <label class="form-check-label">
                                     <input type="radio" name="COSF"  value="Casual"  class="form-control" required >מזדמנת
                                 </label>
                             </div>
                             <div class="form-check-inline">
                                 <label class="form-check-label">
                                     <input type="radio" name="COSF"  value="staying"  class="form-control" required>שוהה
                                 </label>
                             </div>
                         </div></ol>
                 </ol> </p>
                 <p >
                     <label dir="RTL"> 3. מהות החריגה </label>
                 <ol align="right" dir="RTL">
                     <div class="form-group">
                         א. פירוט מהות החריגה מהפמ"ת או מהנחיות תעבורה אווירית.:<input type="text" name="ENOTE"   class="form-control" required>
                     </div> </ol></ol></p>
                 <p ><ol>
                     <label dir="RTL"> 4.נתיב הטיסה  </label>
                     <ol align="right" dir="RTL">
                         <div class="form-group"> א. כיווני טיסה :<input type="text" name="Flight_directions"  class="form-control" required>
                         </div>
                         <div> ב. מסלול טיסה : </div>
                     </ol>
                     <ol align="right" dir="RTL">
                     </ol></p>
                 <h3 class="text-center text-info"> : הוספת טבלה מסלול טיסה</h3><input type="button" onclick="addARow()" id="addRow" value="+"></input>
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
                    echo "<TR>
                         <TD><INPUT type=\"button\" id=\"removeRow\" onclick=\"RemoveRow(this)\"  name=\"chk\" value=\"-\"/></TD>
                         <TD class=\"number\"> 1 </TD>
                         <TD > <div class=\"form-group\"> נקודת התחלה: <INPUT type=\"text\" name=\"start_point[]\"  class=\"form-control\" required /> </TD></div>
                         <TD > <div class=\"form-group\"> נקודת סיום : <INPUT type=\"text\" name=\"end_point[]\"  class=\"form-control\" required /> </TD></div>
                         <TD style=\"word-wrap: break-word;max-width: 150px;\" > <div class=\"form-group\"> גובה במסלול זה :<INPUT type=\"text\" name=\"Track_height[]\" class=\"form-control\" required /> </TD></div>
                         <TD>
                         <div class=\"form-group\">
                                <input type=\"hidden\" name=\"oldimage\">
                                <input type=\"file\" name=\"image[]\"  class=\"custom-fle\" accept=\"image/gif, image/jpeg, image/png\">
                         </div>
                         </TD>
                    </TR>";
                 ?>
                 </TABLE>
                    <p align="center" dir="RTL"> * נקודות ציון ברשת WGS84 בפורמט DMS.</p>
                    </ol>
                    <br>

                    <p dir= "rtl" > 5.זמני ביצוע</p>

                    <div class="form-group"dir="RTL" >  א. פירוט תאריכים ושעות. <br>
                        תאריך התחלה  :<input type="date"  name="DateStart" placeholder="Datum" class="datePickerPlaceHolder" value=""/> תאריך סיום :<input type="date" placeholder="Choose a Date" name="DateEnd"/><br><br>
                        שעת התחלה :<input type='time' id='myTime' name="HourStart"/> שעת סיום :<input type='time' id='myTime' name="HourEnd"/>
                    </div>
                    <br>
                    <p dir= "rtl" > 6.   מידע מסייע נוסף  </p>
                    <div class="form-group"dir="RTL" >
                        א. באם קיים מידע מסייע להבנת מתאר הטיסה יש לפרט על כך: <input type="text" name="Explain_the_nature_of_the_flight"  class="form-control" required>
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
             <input type="submit" class="btn btn-primary" value="SEND"/>
         </div>
        </div>
    </form>
</div>