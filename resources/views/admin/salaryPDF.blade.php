<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Salary Slip</title>

  <style type="text/css">
    
    /* Outlines the grids, remove when sending */
    //table td { border: 1px solid cyan; }

    /* CLIENT-SPECIFIC STYLES */
    body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
    table, td { --mso-table-lspace: 0pt; --mso-table-rspace: 0pt; }
    img { --ms-interpolation-mode: bicubic; }

    /* RESET STYLES */
    img { border: 0; outline: none; text-decoration: none; }
    table { border-collapse: collapse !important; }
    body { margin: 0 !important; padding: 0 !important; width: 100% !important; }

    /* iOS BLUE LINKS */
    a[x-apple-data-detectors] {
      color: inherit !important;
      text-decoration: none !important;
      font-size: inherit !important;
      font-family: inherit !important;
      font-weight: inherit !important;
      line-height: inherit !important;
    }

    /* ANDROID CENTER FIX */
    div[style*="margin: 16px 0;"] { margin: 0 !important; }

    /* MEDIA QUERIES */
    /* @media all and (max-width:639px){ 
      .wrapper{ width:320px!important; padding: 0 !important; }
      .container{ width:300px!important;  padding: 0 !important; }
      .mobile{ width:300px!important; display:block!important; padding: 0 !important; }
      .img{ width:100% !important; height:auto !important; }
      *[class="mobileOff"] { width: 0px !important; display: none !important; }
      *[class*="mobileOn"] { display: block !important; max-height:none !important; }
    } */
    /* Print CSS reset
   Author: @randalmaia
   - Remove browser footer and header.
   - Set page margin. 
*/
@page{
  margin:10px;
}

@media print{
   
   /* Set body padding to header and footer */
   body{
    padding: 40px 0;;
   }


   /* All unecessary elements */
   .your-selectors{
      display: none;
   }

   a[href]:after {
      content: " (" attr(href) ")";
   }
 
   a[href^="#"]:after,
   a[href^="javascript"]:after {
      content: "";
   }

    /* Fix Header and footer class on page */
    .footer, 
    .header {
        position: fixed;
        top: 0;
        left: 0;
        height: 40px;
        width: 100%;
        background-color: white;
        margin-left: 25px;
    }

    .footer{
        top: auto;
        bottom: 0;
    }
    
    @page
      counter-increment: page;
      counter-reset: page 1;
    }
    .footer:after { 
      content: "Page " counter(page) " of " counter(pages); 
      color: blue;
      float: right;
    }
}

  </style>    
</head>
<body style="margin:0; padding:0; background-color:#ffffff;">
  
  <span style="display: block; width: 640px !important; max-width: 768px; height: 1px" class="mobileOff"></span>
  

    <table align="center" width="768px" border="1" cellpadding="0" cellspacing="0" bgcolor="#ffffff" style="">
      <tr>
        <td align="center" valign="top" style="">
          
          <table width="100%" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF" style="">
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td width="100%" class="mobile" valign="top" style="font-family:Arial, sans-serif; font-weight: 700; font-size: 14px;padding-left:10px;">
                      <table width="100%" cellpadding="0" cellspacing="0" border="1" class="container">
                        <tr>
                          <img src="{{asset('images/admin_images/logo.png')}}" alt="Tridhya Tech Pvt. Ltd." width="300">
                        </tr>
                      </table>
                    </td>
                    <td width="50%" class="mobile" align="center" valign="top" style="font-family:Arial, sans-serif; font-weight: 700; font-size: 14px;">
                      <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                        <tr>
                          <td width="50%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;"></td>
                          <td width="50%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px;padding:2px;"></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
            <tr>
              <td height="30" style="font-size:30px; line-height:30px;">&nbsp;</td>
            </tr>
          </table>

          <table width="100%" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF" style="">
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top">

                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td align="center" valign="top" style="font-family:Arial, sans-serif; font-weight: 700; font-size: 14px;">
                      Salary Slip For The Month Of {{$month_year}}
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
          </table>

          <table width="100%" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td width="100%" class="mobile" align="center" valign="top">
                      <table width="100%" cellpadding="0" cellspacing="0" border="1" class="container">
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Employee Code:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px;padding:2px;">{{$emp_code}}</td>
                
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Name of the Bank:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px;padding:2px;">{{$bank_name}}</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Employee Name:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px;padding:2px;">{{$emp_name}}</td>
                        
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Bank Account/Cheque No:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px;padding:2px;">{{$bank_account_no}}</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Department:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px;padding:2px;">{{$department}}</td>
                       
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Date of Joining:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px;padding:2px;">{{$joining_date}}</td>
                        </tr>
                      
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Designation:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px;padding:2px;">{{$designation}}</td>
                        
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;" nowrap>PAN:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px;padding:2px;">{{$pan_no}}</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Status:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px;padding:2px;">{{$status}}</td>
                        
                          <td colspan="2" width="50%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;"></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
          </table>

          <table width="100%" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td width="100%" class="mobile" align="center" valign="top">
                      <table width="100%" cellpadding="0" cellspacing="0" border="1" class="container">
                        <tr>
                          <td align="center" width="50%" colspan="2" width="100%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">EL Details</td>
                          <td align="center" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Attendance Details</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Days</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Opening Bal:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($opening_bal,1)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Working Days:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($working_days,1)}}</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Issue:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($leave_issue,1)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Present Days:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($present_days,1)}}</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Adjustment:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($el_adjustment,1)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Leave Without Pay:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($leave_without_pay,1)}}</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Lapsed:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($lapsed,1)}}</td>
                          <td colspan="2" width="50%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;"></td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">El Encash:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($el_encash,1)}}</td>
                          <td colspan="2" width="50%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;"></td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Balance C/F:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($balance_cf,1)}}</td>
                          <td colspan="2" width="50%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;"></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
          </table>

          <table width="100%" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
            <tr>
              <td align="center" valign="top">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td width="100%" class="mobile" align="center" valign="top">
                      <table width="100%" cellpadding="0" cellspacing="0" border="1" class="container">
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Earnings</td>
                          <td width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">CTC Amount</td>
                          <td width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Salary Amt.</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Deduction</td>
                          <td width="25%" valign="top" align="right" style="font-family: Arial,sans-serif;font-size: 14px; font-weight: 700;padding:2px;">Amount</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Basic Salary:</td>
                          <td align="right" width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($basic_salary,2)}}</td>
                          <td align="right" width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($basic_salary,2)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Professional Tax:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($pro_tax,2)}}</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Performance Allowance</td>
                          <td align="right" width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;"></td>
                          <td align="right" width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($performance_allowance,2)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">PF Contribution</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($pf_contribution,2)}}</td>
                        </tr>
                        <!-- <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Conveyance Allow.</td>
                          <td align="right" width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($conveyance_allowance,2)}}</td>
                          <td align="right" width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($conveyance_allowance,2)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">&nbsp;</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">&nbsp;</td>
                        </tr> -->
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">HRA</td>
                          <td align="right" width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($hra,2)}}</td>
                          <td align="right" width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($hra,2)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Income Tax</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($income_tax,2)}}</td>
                        </tr>
                        <!-- <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Variable</td>
                          <td align="right" width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($variable,2)}}</td>
                          <td align="right" width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($variable,2)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">&nbsp;</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">&nbsp;</td>
                        </tr> -->
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Other Allowance</td>
                          <td align="right" width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($other_allowance,2)}}</td>
                          <td align="right" width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($other_allowance,2)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Leave Without Pay:</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($leave_without_pay_amount,2)}}</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Other Earning</td>
                          <td align="right" width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;"></td>
                          <td align="right" width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($other_earning,2)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Loyalty Bonds</td>
                          <td align="right" width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($loyalty_bond,2)}}</td>
                        </tr>
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">EL Encash Amount</td>
                          <td align="right" width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;"></td>
                          <td align="right" width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($el_encash_amount,2)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Total Deduction:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($total_deduction,2)}}</td>
                        </tr>
                        <!-- <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Other</td>
                          <td align="right" width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($other,2)}}</td>
                          <td align="right" width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($other,2)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">&nbsp;</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">&nbsp;</td>
                        </tr> -->
                        <tr>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px; font-weight:700;">Total Earnings</td>
                          <td align="right" width="15%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($total_salary_earning,2)}}</td>
                          <td align="right" width="10%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($total_salary_amount,2)}}</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">Net Amount:</td>
                          <td width="25%" valign="top" style="font-family: Arial,sans-serif;font-size: 14px; padding:2px;">{{number_format($net_salary,2)}}</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
          </table>

          <table width="100%" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF" style="">
            <tr>
              <td align="center" valign="top">

                <table width="100%" cellpadding="0" cellspacing="0" border="0" class="container">
                  <tr>
                    <td align="center" valign="top" style="font-family:Arial, sans-serif; font-size: 12px;">
                      This salary slip is auto generated by computer which does not require signature.
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
            <tr>
              <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
            </tr>
          </table>

        </td>
      </tr>
    </table>


</body>
</html>