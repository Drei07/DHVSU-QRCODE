<?php
include_once  __DIR__ . '/../../database/dbconfig2.php';
session_start();

require '../vendor2/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

$inputFileName = 'student-attendance.xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);

$starting_row = 9;
$month = $_GET['date'];


$pdoQuery = "SELECT * FROM student_activity WHERE MONTH(date) = :date";
$pdoResult = $pdoConnect->prepare($pdoQuery);
$pdoExec = $pdoResult->execute(array(":date" => $month));

if ($pdoResult->rowCount() == 1) {



    while ($room_data = $pdoResult->fetch(PDO::FETCH_ASSOC)) {

        $student = array($room_data["last_name"], $room_data["first_name"], $room_data["middle_name"]);
        $student_name = $student[0] . ", " . $student[1] . " " . $student[2];


        $sheet = $spreadsheet->getSheetByName('front')
            ->setCellValue('A' . $starting_row, $room_data['employee_name'])
            ->setCellValue('I' . $starting_row, $room_data['studentId'])
            ->setCellValue('K' . $starting_row, $student_name)
            ->setCellValue('S' . $starting_row, $room_data['sex'])
            ->setCellValue('T' . $starting_row, $room_data['birth_date'])
            ->setCellValue('W' . $starting_row, $room_data['age'])
            ->setCellValue('X' . $starting_row, $room_data['religion'])
            ->setCellValue('AB' . $starting_row, $room_data['phone_number'])
            ->setCellValue('AF' . $starting_row, $room_data['email'])
            ->setCellValue('AJ' . $starting_row, $room_data['barangay'])
            ->setCellValue('AO' . $starting_row, $room_data['city'])
            ->setCellValue('AT' . $starting_row, $room_data['province'])
            ->setCellValue('AX' . $starting_row, $room_data['date']);


        $starting_row++;
    }

    // MONTHS
    switch ($month) {
        case '01':
           $month_name = "January";
            break;
        case '02':
            $month_name = "February";
            break;
        case '03':
            $month_name = "March";
            break;
        case '04':
            $month_name = "April";
            break;
        case '05':
            $month_name = "May";
            break;
        case '06':
            $month_name = "June";
            break;
        case '07':
            $month_name = "July";
            break;
        case '08':
            $month_name = "August";
            break;
        case '09':
            $month_name = "September";
            break;
        case '10':
            $month_name = "October";
            break;
        case '11':
            $month_name = "November";
            break;
        case '12':
            $month_name = "December";
            break;
    }
    




    ob_end_clean();
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$month_name.'-student-attendance-' . date("Y-m-d") . '.xlsx"');

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
} else {
    $_SESSION['status_title'] = "Oops!";
    $_SESSION['status'] = "No records found for this month";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_timer'] = 100000;
    header("Location: ../superadmin/room-list");
}
