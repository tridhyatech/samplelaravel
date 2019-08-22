<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Invoice</title>
	<link rel="stylesheet" href="">
	<style>
	/* 2 Equal-Width Columns V2 Layout Pattern CSS */
	table {
    border-collapse: collapse;
}
	@media only screen and (max-width: 599px) {
        td[class="pattern"] table { width: 100%; }
        td[class="pattern"] .hero_image img {
            width: 100%;
            height: auto !important;
        }
	}
    @media only screen and (max-width: 450px) {
        td[class="pattern"] .spacer { display: none; }
        td[class="pattern"] .col{
            width: 100%;
            display: block;
        }
        td[class="pattern"] .col:first-child { margin-bottom: 30px; }
        td[class="pattern"] .hero_image img { width: 100%; }
    }
    .responsive {
        display:block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar
    }

</style>
</head>
<body>
	<div class="responsive">
<table cellpadding="0" cellspacing="0" style="margin:0 auto;padding:10px;">
    <tr>
        <td class="pattern" width="640" align="right">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="col" width="640" valign="top" style="border-bottom: 3px solid #eee;">
                        <table cellpadding="0" cellspacing="0" style="width:100%;">
                            <tr>
                                <td class="" style="font-family: arial,sans-serif; font-size: 14px;text-align: center;" align="">
                                	<h3><strong>Salary Slip for the month of {{$month_year}}</strong></h3>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="pattern" width="640" align="left" style="padding-bottom:10px;padding-top: 25px;">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="col" width="290" valign="top">
                        <table cellpadding="0" cellspacing="0">
							<tr>
                                <td class="hero_image" style="padding-bottom:10px;">
                                	<img src="{{public_path('images/admin_images/logo.png')}}" width="280" alt="Tridhya Tech Pvt. Ltd." style="display: block; border: 0;max-width: 300px;" />
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #000000; padding-top: 10px;">
                                    1118-1121, i SQUARE Corporate Park, <br>
									Before Shukan Mall, <br>
									Science City Road,Sola, <br>
									Ahmedabad -364060 <br><br>
									Phone: <a href="tel:+91 79-4890-7944" style="color:#ff9600;">+91 79-4890-7944</a> <br>
									Email: <a href="mailto:info@tridhyatech.com" style="color:#ff9600;">info@tridhyatech.com</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td class="spacer" width="20" style="font-size: 3px;">&nbsp;</td>
                    <td class="col" width="330" valign="top" align="right">
                        <table cellpadding="0" cellspacing="0" align="right">
                        	<tr>
                                <td class="body_copy" align="Left" style="font-family: arial,sans-serif; font-size: 14px; padding: 5px; border:3px solid #eee;">
                                	<strong>Employee Code:</strong>
                                </td>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px; color: #000000; padding: 5px; border:3px solid #eee;">
                                	<strong>{{$emp_code}}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="Left" style="font-family: arial,sans-serif; font-size: 14px;padding:5px; border:3px solid #eee;">
                                	<strong>Employee Name:</strong>
                                </td>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px;padding:5px; border:3px solid #eee;">
                                {{$emp_name}}
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="Left" style="font-family: arial,sans-serif; font-size: 14px;padding:5px; border:3px solid #eee;">
                                	<strong>Employee Email:</strong>
                                </td>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px;padding:5px; border:3px solid #eee;">
                                	<a href="mailto:info@tridhyatech.com" style="color:#ff9600;">{{$emp_email}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="Left" style="font-family: arial,sans-serif; font-size: 14px;padding:5px; border:3px solid #eee;">
                                	<strong>Designation:</strong>
                                </td>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px;padding:5px; border:3px solid #eee;">
                                {{$designation}}
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="Left" style="font-family: arial,sans-serif; font-size: 14px;padding:5px; border:3px solid #eee;">
                                	<strong>Invoice Month:</strong>
                                </td>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px;padding:5px; border:3px solid #eee;">
                                    {{$month_year}} 
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="Left" style="font-family: arial,sans-serif; font-size: 14px;border:3px solid #eee;padding:5px;">
                                	<strong>Working Days:</strong>
                                </td>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px;border:3px solid #eee;padding:5px;">
                                    {{$working_days}}
                                </td>
                            </tr>
                            <tr>
                                <td class="body_copy" align="Left" style="font-family: arial,sans-serif; font-size: 14px;border:3px solid #eee;padding:5px;">
                                	<strong>Present Days:</strong>
                                </td>
                                <td class="body_copy" align="left" style="font-family: arial,sans-serif; font-size: 14px;border:3px solid #eee;padding:5px;">
                                    {{$present_days}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="pattern" width="640" align="center">
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="col" width="640" valign="top" style="padding-top:30px;">
                        <table cellpadding="0" cellspacing="0" style="width: 100%;border:3px solid #eee;">
                            <tr>
                                <td class="heading" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #000;font-weight: 700; padding:10px 5px;background-color: #eee;">Earnings</td>
                                <td class="heading" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #000;font-weight: 700; text-align:right; padding:10px 5px;background-color: #eee;">CTC Amount</td>
                                <td class="heading" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #000;font-weight: 700; text-align:right; padding:10px 5px;background-color: #eee;">Salary Amount</td>
                                <td class="heading" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #000;font-weight: 700; padding:10px 5px;background-color: #eee;">Deduction</td>
                                <td class="heading" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #000;font-weight: 700; text-align:right; padding:10px 5px;background-color: #eee;">Amount</td>
                            </tr>
                            <tr>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;border:3px solid #eee;"><strong>Basic Salary</strong></td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #eee;">{{number_format($basic_salary,2)}}</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #eee;">{{ number_format($salary_basic_amount,2)}}</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;border:3px solid #eee;">PF Employee's Contribution</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #eee;">{{number_format($pf_contribution,2)}}</td>
                            </tr>
                            <tr>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;border:3px solid #ddd;"><strong>House Rent Allownces</strong></td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;">{{number_format($house_rent_allow,2)}}</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;">{{number_format($salary_house_rent_allow,2)}}</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;border:3px solid #ddd;">Professional Tax</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;">{{number_format($pro_tax,2)}}</td>
                            </tr>
                            <tr>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000;  padding:10px 5px;border:3px solid #ddd;"><strong>Other Allownces</strong></td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;">{{number_format($other_allow,2)}}</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;">{{  number_format($salary_other_amt,2)}}</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;border:3px solid #ddd;">Income Tax</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;">{{number_format($inc_tax,2)}}</td>
                            </tr>
                            <tr>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;border:3px solid #ddd;"><strong>EL Encash Amount</strong></td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;"></td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;">{{number_format($el_encash,2)}}</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;border:3px solid #ddd;">Loyalty Bond</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;">{{number_format($loyalty_bond,2)}}</td>
                            </tr>
                            <tr>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;border:3px solid #ddd;"><strong>Other</strong></td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;"></td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;">{{number_format($other_earning,2)}}</td>
                            	<td colspan="2" style="border:3px solid #ddd;"></td>
                            </tr>
                            <tr>
                            	<td colspan="3"style="border:3px solid #ddd;"></td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;border:3px solid #ddd;"><strong>Total Deduction</strong></td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;border:3px solid #ddd;">{{  number_format($total_deduction,2)}}</td>
                            </tr>
                            <tr>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;font-weight: 700;border:3px solid #ddd;">Total Earnings</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;font-weight: 700;border:3px solid #ddd;">{{number_format(round($total_earning,2),2)}}</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;font-weight: 700;border:3px solid #ddd;">{{ number_format(round($salary_total_amount,2),2)}}</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; padding:10px 5px;font-weight: 700;border:3px solid #ddd;">Net Amount</td>
                            	<td style="font-family: arial,sans-serif; font-size: 14px; color: #000; text-align: right; padding:10px 5px;font-weight: 700;border:3px solid #ddd;">{{number_format(round($salary_net_amount,2),2)}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>
 
</body>
</html>