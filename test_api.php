<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>จังหวัด</th>
            <th>โรคลมชัก</th>
            <th>โรคสมาธิสั้น</th>
            <th>โรคออทิสติก</th>
            <th>ผู้ป่วยติดเกมส์ในผู้ใหญ่ [15 ปีขึ้นไป]</th>
            <th>ติดยาบ้า [Amphetamine]</th>
            <th>โรคอารมณ์สองขั้ว</th>
            <th>ผู้ป่วยติดเกมส์ในเด็ก [อายุต่ำกว่า 15 ปี]</th>
            <th>ความบกพร่องทางสติปัญญา</th>
            <th>พยามยามฆ่าตัวตาย [การตั้งใจทำร้ายตนเอง]</th>
            <th>โรควิตกกังวล</th>
            <th>ติดแอลกอฮอลล์</th>
            <th>โรคซึมเศร้า</th>
            <th>ความบกพร่องทางการเรียนรู้</th>
            <th>โรคสมองเสื่อม</th>
            <th>โรคจิตเภท</th>
            <th>โรคจิตอื่นๆ</th>
            <th>ติดสารเสพติดอื่นๆ</th>
            <th>โรคทางจิตเวชอื่นๆ</th>
        </tr>
    </thead>

</table>

<script>
$(document).ready(function() {
    $('#example').dataTable({
        ajax: {
            url: 'test.php',
            contentType: 'application/json',
            type: 'GET',
            data: function(d) {
                return JSON.stringify(d);
            }
        },
        columns: [{
                data: "ลำดับ"
            },
            {
                data: "จังหวัด"
            },
            {
                data: "โรคลมชัก"
            },
            {
                data: "โรคสมาธิสั้น"
            },
            {
                data: "โรคออทิสติก"
            },
            {
                data: "ผู้ป่วยติดเกมส์ในผู้ใหญ่ [15 ปีขึ้นไป]"
            },
            {
                data: "ติดยาบ้า [Amphetamine]"
            },
            {
                data: "โรคอารมณ์สองขั้ว"
            },
            {
                data: "ผู้ป่วยติดเกมส์ในเด็ก [อายุต่ำกว่า 15 ปี]"
            },
            {
                data: "ความบกพร่องทางสติปัญญา"
            },
            {
                data: "พยามยามฆ่าตัวตาย [การตั้งใจทำร้ายตนเอง]"
            },
            {
                data: "โรควิตกกังวล"
            },
            {
                data: "ติดแอลกอฮอลล์"
            },
            {
                data: "โรคซึมเศร้า"
            },
            {
                data: "ความบกพร่องทางการเรียนรู้"
            },
            {
                data: "โรคสมองเสื่อม"
            },
            {
                data: "โรคจิตเภท"
            },
            {
                data: "โรคจิตอื่นๆ"
            },
            {
                data: "ติดสารเสพติดอื่นๆ"
            },
            {
                data: "โรคทางจิตเวชอื่นๆ"
            }
        ]
    });
});
</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>