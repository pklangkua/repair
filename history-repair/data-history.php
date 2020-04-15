<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
<thead>
        <tr>
            <th>พัสดุ</th>
            <th>วันที่แจ้งซ่อม</th>
            <th>วันที่รับซ่อม</th>
            <th>ผู้ปฎิบัติงาน</th>
            <th>สถานะการซ่อม</th>
            <th>รายละเอียด</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td>2011/04/25</td>
            <td><button type="button" class="btn btn-danger " onclick="window.location.href = '?module=data-history-detail';" >รายละเอียด</button></td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
        <th>พัสดุ</th>
            <th>วันที่แจ้งซ่อม</th>
            <th>วันที่รับซ่อม</th>
            <th>ผู้ปฎิบัติงาน</th>
            <th>สถานะการซ่อม</th>
            <th>รายละเอียด</th>
        </tr>
    </tfoot>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>