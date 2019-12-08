<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$student->first_name}}</title>
    <style>
  
  
    .table1 , .table2{
        border:1px solid grey;
        width: 100%;
    }
   
    .table2 tr td,.table2 tr th{
        border:1px solid grey;
        padding:10px;
    }
    .table2{
        border-top:none;
    }
    </style>
</head>
<body>
    <h1><center>Payment Reciept</center></h1>
 
    <table class="">
        <tr>
            <td rowspan="3"><img src="logo" width="100" height="100"></td>
        
        </tr>
        <tr>
            <td><h3>Dcodetech</h3>
            <p>Email : dcodetech24@gmail.com | Contact : 8455855588</p>
            <p>Address : Thane west</p></td>
        </tr>
    </table>
    <table class="table1">
        <tr>
            <td width="20%">Receipt No.</td>
            <td width="80%">{{$fee_->id}}</td>
        </tr>
        <tr>
            <td>Payment Date</td>
            <td>{{date("d-m-Y",strtotime($fee_->due_date))}}</td>
        </tr>
        <tr>
            <td>Student Name</td>
            <td>{{$student->first_name.' '.$student->last_name }}</td>
        </tr>
        <tr>
            <td>Registration ID</td>
            <td>{{$student->id}}</td>
        </tr> <tr>
            <td>Course Applied</td>
            <td>{{$course->name}}</td>
        </tr>
    </table>
    <table class="table2" cellspacing="0" cellpadding=0>
        <tr>
            <th>Sr .no </th>
            <th>Paid For</th>
            <th>Amount</th>
        </tr>
        <tr>
           <td>1</td>
           <td>{{$fee_->naration}}</td>
           <td>{{$fee_->amount_due?$fee_->amount_due:$fee_->amount}}</td>
        </tr>
        <tr>
            <td colspan="2"><b>Grand Total</b></td>
            <td><b>{{$fee_->amount_due?$fee_->amount_due:$fee_->amount}}</b></td>
        </tr>
        <tr>
            <td colspan="3">Payment Mode : Cash | Payment Status : Cleared 
            </td>
        </tr>
        <tr>
            <td colspan="3">Terms:<br>
                A) Any Fee paid under any head is neither refundable nor transferable under any circumstances.<br>
                B) For detail rules check the fees section of Tutor Point diary .<br>
                C) All matters are subject to Parramatta jurisdiction only.</td>
        </tr>
    </table>
</body>
</html>