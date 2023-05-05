<?php
// ini_set('display_errors', 1);// show error reporting
// error_reporting(E_ALL);
include 'sample_mail_content.php';
$mail_order = new MailTemplate;
//$data = '{
//    "status_code": 200,
//    "message": "Orders listed successfully !",
//    "data": {
//        "distributor_name": "",
//        "distributor_email": "",
//        "header_logo": "",
//        "brand_colour": "",
//        "id": "989",
//        "token": "6274745140",
//        "booking_number": "627706174181",
//        "user_token": "2269164922",
//        "user_name": "",
//        "user_mobile": "+917092257763",
//        "user_email": "",
//        "for_others": false,
//        "journey": "AMS - CAI",
//        "service_amount": "4873",
//        "service_gst": "877",
//        "convenience_fee": "173",
//        "cf_tax": "32",
//        "total_amount": "5955",
//        "currency": "INR",
//        "payment_view": "5955.00",
//        "total_service": "1",
//        "total_adult": "2",
//        "total_children": "0",
//        "service_dates": [
//            "17 Nov 2022"
//        ],
//        "type": "INR",
//        "booking_type": "Web",
//        "date_time": "14 Nov 2022",
//        "status": "Pending",
//        "e_ticket": "https:\/\/d1xqjehqvi7b4u.cloudfront.net\/user\/e_ticket\/1668404358475.pdf",
//        "pancard_number": "GEFG6373VFF",
//        "gst_name": "Kalinn bhaui",
//        "gst_number": "GHUEG3762HGGH2",
//        "description_one": "",
//        "description_two": "",
//        "payment_id": "pay_Kfo4hvkq7T7Scx",
//        "invoice_pdf": "https:\/\/airportzostage.in\/invoice_pdf\/6274745140.pdf",
//        "airportzo_cancel_fee": "150",
//        "order_detail": [
//            {
//                "airport_token": "9244043212",
//                "gmt_view": "+05:30",
//                "airport_name": "Amsterdam Airport Schiphol",
//                "airport_code": "AMS",
//                "terminal_token": "9876543210",
//                "terminal_name": "Terminal 1",
//                "station_number": 1,
//                "order_detail_array": [
//                    {
//                        "id": "1703",
//                        "token": "4869359799",
//                        "booking_token": "6274745140",
//                        "airport_token": "9244043212",
//                        "airport_name": "Amsterdam Airport Schiphol",
//                        "airport_code": "AMS",
//                        "terminal_token": "9876543210",
//                        "terminal_name": "Terminal 1",
//                        "company_token": "7948231975",
//                        "company_name": "Pravinmarhaba",
//                        "company_email": "pravinmichal@gmail.com",
//                        "company_logo": "https:\/\/d1xqjehqvi7b4u.cloudfront.net\/service_provider_company\/documents\/1663586642975.png",
//                        "company_image": "https:\/\/d1xqjehqvi7b4u.cloudfront.net\/service_provider_company\/documents\/1663586652298.png",
//                        "station_number": 1,
//                        "flight_number": "",
//                        "airport_type": "1573827082",
//                        "airport_category": "1122334456",
//                        "service_date_time": "17 Nov, 2022 00:00",
//                        "service_date": "17 Nov, 2022",
//                        "service_time": "12:00 AM",
//                        "service_date_time_raw": "2022-11-17 00:00:00",
//                        "service_token": "DF0Z3E26HT",
//                        "service_name": "Domestic-Departure-Elite (With Lounge)",
//                        "service_type": "Individual",
//                        "service_location_token": "CLF5NMAP06",
//                        "journey_date": "-",
//                        "journey": "",
//                        "date_time": "2022-11-14 05:40:28",
//                        "status": "Pending",
//                        "adult_service_amount": "2875",
//                        "total_adult": "2",
//                        "children_service_amount": "1800",
//                        "total_children": "0",
//                        "net_amount": 5750,
//                        "notes": "",
//                        "rating": "0",
//                        "review": "",
//                        "description": "",
//                        "report_reason_token": "",
//                        "report_reason": "",
//                        "report_description": "",
//                        "reported_date_time": "30 Nov,-0001 12:00 AM",
//                        "cancellation_policy_detail": [
//                            {
//                                "hours": "24",
//                                "percentage": "20"
//                            }
//                        ],
//                        "reschedule_policy": "Schedule time send via sms",
//                        "can_be_cancelled": true,
//                        "cancelled_by": "",
//                        "cancellation_detail": {
//                            "cancellation_hours": "24",
//                            "cancellation_fee": "1150",
//                            "cancellation_fee_perc": "20",
//                            "airportzo_fee": "150",
//                            "max_airportzo_fee": "150",
//                            "cancelled_date": "-",
//                            "refund_amount": "4450",
//                            "refund_status": "Pending",
//                            "refunded_date": "-"
//                        },
//                        "az_sp_commision_amount": "0",
//                        "sp_balance_credit": "-82375"
//                    },
//                     {
//                        "id": "1703",
//                        "token": "4869359799",
//                        "booking_token": "6274745140",
//                        "airport_token": "9244043212",
//                        "airport_name": "Amsterdam Airport Schiphol",
//                        "airport_code": "AMS",
//                        "terminal_token": "9876543210",
//                        "terminal_name": "Terminal 1",
//                        "company_token": "7948231975",
//                        "company_name": "Pravinmarhaba",
//                        "company_email": "pravinmichal@gmail.com",
//                        "company_logo": "https:\/\/d1xqjehqvi7b4u.cloudfront.net\/service_provider_company\/documents\/1663586642975.png",
//                        "company_image": "https:\/\/d1xqjehqvi7b4u.cloudfront.net\/service_provider_company\/documents\/1663586652298.png",
//                        "station_number": 1,
//                        "flight_number": "",
//                        "airport_type": "1573827082",
//                        "airport_category": "1122334456",
//                        "service_date_time": "17 Nov, 2022 00:00",
//                        "service_date": "17 Nov, 2022",
//                        "service_time": "12:00 AM",
//                        "service_date_time_raw": "2022-11-17 00:00:00",
//                        "service_token": "DF0Z3E26HT",
//                        "service_name": "Domestic-Departure-Elite (With Lounge)",
//                        "service_type": "Individual",
//                        "service_location_token": "CLF5NMAP06",
//                        "journey_date": "-",
//                        "journey": "",
//                        "date_time": "2022-11-14 05:40:28",
//                        "status": "Pending",
//                        "adult_service_amount": "2875",
//                        "total_adult": "2",
//                        "children_service_amount": "1800",
//                        "total_children": "0",
//                        "net_amount": 5750,
//                        "notes": "",
//                        "rating": "0",
//                        "review": "",
//                        "description": "",
//                        "report_reason_token": "",
//                        "report_reason": "",
//                        "report_description": "",
//                        "reported_date_time": "30 Nov,-0001 12:00 AM",
//                        "cancellation_policy_detail": [
//                            {
//                                "hours": "24",
//                                "percentage": "20"
//                            }
//                        ],
//                        "reschedule_policy": "Schedule time send via sms",
//                        "can_be_cancelled": true,
//                        "cancelled_by": "",
//                        "cancellation_detail": {
//                            "cancellation_hours": "24",
//                            "cancellation_fee": "1150",
//                            "cancellation_fee_perc": "20",
//                            "airportzo_fee": "150",
//                            "max_airportzo_fee": "150",
//                            "cancelled_date": "-",
//                            "refund_amount": "4450",
//                            "refund_status": "Pending",
//                            "refunded_date": "-"
//                        },
//                        "az_sp_commision_amount": "0",
//                        "sp_balance_credit": "-82375"
//                    }
//                ],
//                "airport_type": "Departure",
//                "flight_number": "HFHE2"
//            }
//        ],
//        "passenger_detail": [
//            {
//                "passenger_type": "Contact",
//                "passenger_array": [
//                    {
//                        "id": "1502",
//                        "token": "9109139210",
//                        "booking_token": "6274745140",
//                        "passenger_type": "Contact",
//                        "user_passenger_token": "7496889035",
//                        "title": "Mr",
//                        "name": "Sundar",
//                        "name_view": "Mr. Sundar",
//                        "country_code": "+91",
//                        "mobile_number": "7092257763",
//                        "mobile_view": "+917092257763",
//                        "email_id": "premkumar@macappstudio.com",
//                        "date_of_birth": "1970-01-01",
//                        "age": "-"
//                    }
//                ]
//            },
//            {
//                "passenger_type": "Others",
//                "passenger_array": [
//                    {
//                        "id": "1503",
//                        "token": "9983914548",
//                        "booking_token": "6274745140",
//                        "passenger_type": "Others",
//                        "user_passenger_token": "4960220635",
//                        "title": "Mr",
//                        "name": "Rajesh",
//                        "name_view": "Mr. Rajesh",
//                        "country_code": "+91",
//                        "mobile_number": "7092257763",
//                        "mobile_view": "+917092257763",
//                        "email_id": "prem@gmail.com",
//                        "date_of_birth": "1970-01-01",
//                        "age": "-"
//                    }
//                ]
//            }
//        ],
//        "journey_detail": [
//            {
//                "id": "1100",
//                "token": "6550041919",
//                "booking_token": "6274745140",
//                "depart_ttr_token": "8808682624",
//                "depart_airport_code": "AMS",
//                "depart_airport": "Amsterdam Airport Schiphol",
//                "depart_terminal": "Terminal 1",
//                "arrival_airport_code": "CAI",
//                "arrival_airport": "Cairo International Airport",
//                "arrival_terminal": "Terminal 1",
//                "arrival_ttr_token": "8254559958",
//                "depart_date": "15 Nov, 2022",
//                "flight_number": "HFHE2"
//            }
//        ]
//    }
//}';

$data ='{
    "status_code": 200,
    "message": "Orders listed successfully !",
    "data": {
        "distributor_name": "",
        "distributor_email": "",
        "header_logo": "",
        "brand_colour": "",
        "id": "1015",
        "token": "2585482827",
        "booking_number": "905232205380",
        "user_token": "2269164922",
        "user_name": "",
        "user_mobile": "+917092257763",
        "user_email": "",
        "for_others": false,
        "journey": "AMS - CAI",
        "service_amount": "44710",
        "service_gst": "8047",
        "convenience_fee": "1583",
        "cf_tax": "285",
        "total_amount": "54625",
        "currency": "INR",
        "payment_view": "54625.00",
        "total_service": "3",
        "total_adult": "2",
        "total_children": "1",
        "service_dates": [
            "17 Nov 2022",
            "18 Nov 2022"
        ],
        "type": "INR",
        "booking_type": "Web",
        "date_time": "15 Nov 2022",
        "status": "Pending",
        "e_ticket": "https:\/\/d1xqjehqvi7b4u.cloudfront.net\/user\/e_ticket\/1668506354960.pdf",
        "pancard_number": "FGDE545EFCFT65",
        "gst_name": "",
        "gst_number": "",
        "description_one": "",
        "description_two": "",
        "payment_id": "pay_KgH1gzkLdQPWaE",
        "invoice_pdf": "https:\/\/airportzostage.in\/invoice_pdf\/2585482827.pdf",
        "airportzo_cancel_fee": "150",
        "order_detail": [
            {
                "airport_token": "9244043212",
                "gmt_view": "+05:30",
                "airport_name": "Amsterdam Airport Schiphol",
                "airport_code": "AMS",
                "terminal_token": "9876543210",
                "terminal_name": "Terminal 1",
                "station_number": 1,
                "order_detail_array": [
                    {
                        "id": "1750",
                        "token": "9022242678",
                        "booking_token": "2585482827",
                        "airport_token": "9244043212",
                        "airport_name": "Amsterdam Airport Schiphol",
                        "airport_code": "AMS",
                        "terminal_token": "9876543210",
                        "terminal_name": "Terminal 1",
                        "company_token": "7948231975",
                        "company_name": "Pravinmarhaba",
                        "company_email": "pravinmichal@gmail.com",
                        "company_logo": "https:\/\/d1xqjehqvi7b4u.cloudfront.net\/service_provider_company\/documents\/1663586642975.png",
                        "company_image": "https:\/\/d1xqjehqvi7b4u.cloudfront.net\/service_provider_company\/documents\/1663586652298.png",
                        "station_number": 1,
                        "flight_number": "",
                        "airport_type": "1573827082",
                        "airport_category": "1122334456",
                        "service_date_time": "17 Nov, 2022 16:00",
                        "service_date": "17 Nov, 2022",
                        "service_time": "04:00 PM",
                        "service_date_time_raw": "2022-11-17 16:00:00",
                        "service_token": "DF0Z3E26HT",
                        "service_name": "Domestic-Departure-Elite (With Lounge)",
                        "service_type": "Individual",
                        "service_location_token": "CLF5NMAP06",
                        "journey_date": "-",
                        "journey": "",
                        "date_time": "2022-11-15 09:59:44",
                        "status": "Pending",
                        "adult_service_amount": "2875",
                        "total_adult": "2",
                        "children_service_amount": "1800",
                        "total_children": "1",
                        "net_amount": 7550,
                        "notes": "",
                        "rating": "0",
                        "review": "",
                        "description": "",
                        "report_reason_token": "",
                        "report_reason": "",
                        "report_description": "",
                        "reported_date_time": "30 Nov,-0001 12:00 AM",
                        "cancellation_policy_detail": [
                            {
                                "hours": "24",
                                "percentage": "20"
                            }
                        ],
                        "reschedule_policy": "Schedule time send via sms",
                        "can_be_cancelled": true,
                        "cancelled_by": "",
                        "cancellation_detail": {
                            "cancellation_hours": "24",
                            "cancellation_fee": "1510",
                            "cancellation_fee_perc": "20",
                            "airportzo_fee": "150",
                            "max_airportzo_fee": "150",
                            "cancelled_date": "-",
                            "refund_amount": "5890",
                            "refund_status": "Pending",
                            "refunded_date": "-"
                        },
                        "az_sp_commision_amount": "0",
                        "sp_balance_credit": "-123000"
                    },
                    {
                        "id": "1751",
                        "token": "8663559240",
                        "booking_token": "2585482827",
                        "airport_token": "9244043212",
                        "airport_name": "Amsterdam Airport Schiphol",
                        "airport_code": "AMS",
                        "terminal_token": "9876543210",
                        "terminal_name": "Terminal 1",
                        "company_token": "2847476544",
                        "company_name": "Pravin pranaam",
                        "company_email": "pravin@macappstudio.com",
                        "company_logo": "https:\/\/d1xqjehqvi7b4u.cloudfront.net\/service_provider_company\/documents\/1664514447158.png",
                        "company_image": "https:\/\/d1xqjehqvi7b4u.cloudfront.net\/service_provider_company\/documents\/1664514458599.png",
                        "station_number": 1,
                        "flight_number": "",
                        "airport_type": "1573827082",
                        "airport_category": "1122334456",
                        "service_date_time": "17 Nov, 2022 16:00",
                        "service_date": "17 Nov, 2022",
                        "service_time": "04:00 PM",
                        "service_date_time_raw": "2022-11-17 16:00:00",
                        "service_token": "AX0Q8HO2UI",
                        "service_name": "International-Departure-Silver (Without Lounge)",
                        "service_type": "Individual",
                        "service_location_token": "XD34FT9MV1",
                        "journey_date": "-",
                        "journey": "",
                        "date_time": "2022-11-15 09:59:44",
                        "status": "Pending",
                        "adult_service_amount": "2950",
                        "total_adult": "2",
                        "children_service_amount": "2950",
                        "total_children": "1",
                        "net_amount": 8850,
                        "notes": "",
                        "rating": "0",
                        "review": "",
                        "description": "",
                        "report_reason_token": "",
                        "report_reason": "",
                        "report_description": "",
                        "reported_date_time": "30 Nov,-0001 12:00 AM",
                        "cancellation_policy_detail": [
                            {
                                "hours": "48",
                                "percentage": "20"
                            },
                            {
                                "hours": "24",
                                "percentage": "50"
                            }
                        ],
                        "reschedule_policy": "Test",
                        "can_be_cancelled": true,
                        "cancelled_by": "",
                        "cancellation_detail": {
                            "cancellation_hours": "48",
                            "cancellation_fee": "1770",
                            "cancellation_fee_perc": "20",
                            "airportzo_fee": "150",
                            "max_airportzo_fee": "150",
                            "cancelled_date": "-",
                            "refund_amount": "6930",
                            "refund_status": "Pending",
                            "refunded_date": "-"
                        },
                        "az_sp_commision_amount": "0",
                        "sp_balance_credit": "-8850"
                    }
                ],
                "airport_type": "Departure",
                "flight_number": "443224"
            },
            {
                "airport_token": "7807594932",
                "gmt_view": "+05:30",
                "airport_name": "Cairo International Airport",
                "airport_code": "CAI",
                "terminal_token": "9876543211",
                "terminal_name": "Terminal 2",
                "station_number": 2,
                "order_detail_array": [
                    {
                        "id": "1752",
                        "token": "5559862467",
                        "booking_token": "2585482827",
                        "airport_token": "7807594932",
                        "airport_name": "Cairo International Airport",
                        "airport_code": "CAI",
                        "terminal_token": "9876543211",
                        "terminal_name": "Terminal 2",
                        "company_token": "3585484069",
                        "company_name": "Marhaba",
                        "company_email": "vetrikumar@airportzo.com",
                        "company_logo": "https:\/\/d1kbhg7ykrtfl2.cloudfront.net\/service_provider_company\/company_logo\/Marhaba.jpg",
                        "company_image": "https:\/\/d1kbhg7ykrtfl2.cloudfront.net\/service_provider_company\/company_logo\/marhaba_image.png",
                        "station_number": 2,
                        "flight_number": "",
                        "airport_type": "1573827082",
                        "airport_category": "1122334455",
                        "service_date_time": "18 Nov, 2022 02:04",
                        "service_date": "18 Nov, 2022",
                        "service_time": "02:04 AM",
                        "service_date_time_raw": "2022-11-18 02:04:00",
                        "service_token": "8471724742",
                        "service_name": "International-Arrival-Silver (Without Lounge)",
                        "service_type": "Bundle",
                        "service_location_token": "6976343814",
                        "journey_date": "-",
                        "journey": "",
                        "date_time": "2022-11-15 09:59:44",
                        "status": "Pending",
                        "adult_service_amount": "12119",
                        "total_adult": "2",
                        "children_service_amount": "12119",
                        "total_children": "1",
                        "net_amount": 36357,
                        "notes": "",
                        "rating": "0",
                        "review": "",
                        "description": "",
                        "report_reason_token": "",
                        "report_reason": "",
                        "report_description": "",
                        "reported_date_time": "30 Nov,-0001 12:00 AM",
                        "cancellation_policy_detail": [
                            {
                                "hours": "21",
                                "percentage": "127"
                            }
                        ],
                        "reschedule_policy": "fghfghfghfgh",
                        "can_be_cancelled": true,
                        "cancelled_by": "",
                        "cancellation_detail": {
                            "cancellation_hours": "0",
                            "cancellation_fee": "36357",
                            "cancellation_fee_perc": "100",
                            "airportzo_fee": "0",
                            "max_airportzo_fee": "150",
                            "cancelled_date": "-",
                            "refund_amount": "0",
                            "refund_status": "Pending",
                            "refunded_date": "-"
                        },
                        "az_sp_commision_amount": "0",
                        "sp_balance_credit": "-1109570"
                    }
                ],
                "airport_type": "Arrival",
                "flight_number": "443224"
            }
        ],
        "passenger_detail": [
            {
                "passenger_type": "Contact",
                "passenger_array": [
                    {
                        "id": "1582",
                        "token": "5700326878",
                        "booking_token": "2585482827",
                        "passenger_type": "Contact",
                        "user_passenger_token": "1372563971",
                        "title": "Mr",
                        "name": "senthil",
                        "name_view": "Mr. senthil",
                        "country_code": "+91",
                        "mobile_number": "7092257763",
                        "mobile_view": "+917092257763",
                        "email_id": "premkumar@macappstudio.com",
                        "date_of_birth": "1970-01-01",
                        "age": "-"
                    }
                ]
            },
            {
                "passenger_type": "Others",
                "passenger_array": [
                    {
                        "id": "1583",
                        "token": "8513093676",
                        "booking_token": "2585482827",
                        "passenger_type": "Others",
                        "user_passenger_token": "7848120702",
                        "title": "Mr",
                        "name": "Edberg",
                        "name_view": "Mr. Edberg",
                        "country_code": "+91",
                        "mobile_number": "7092257763",
                        "mobile_view": "+917092257763",
                        "email_id": "hhsdhsg@gmail.com",
                        "date_of_birth": "1970-01-01",
                        "age": "-"
                    }
                ]
            }
        ],
        "journey_detail": [
            {
                "id": "1127",
                "token": "9117428535",
                "booking_token": "2585482827",
                "depart_ttr_token": "8808682624",
                "depart_airport_code": "AMS",
                "depart_airport": "Amsterdam Airport Schiphol",
                "depart_terminal": "Terminal 1",
                "arrival_airport_code": "CAI",
                "arrival_airport": "Cairo International Airport",
                "arrival_terminal": "Terminal 2",
                "arrival_ttr_token": "7611817739",
                "depart_date": "16 Nov, 2022",
                "flight_number": "443224"
            }
        ]
    }
}';

$fetch_order_detail = json_decode($data);
$booking_detail = $fetch_order_detail->data;
$mail_order->mail_objs = $booking_detail;
$mail_order->mail_status = 'ORDER CANCELLED';
$mail_order->order_detail_token = "9022242678";
$mail_order->order_airport_token = "9244043212";
$mail_order->mail_for = "service-provider";
$mail_template = $mail_order->getMailContent();
echo $mail_template;
?>