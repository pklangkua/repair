<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<div class="card">
    <div class="card-header">
        ประวัติการทำรายการ
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <form method="post" action="/repair/history-repair/delete-repair.php">

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
                            <td><button type="submit" class="btn btn-danger "
                                    onclick="return confirm('Are you sure you want to delete?')">ลบ</button></td>
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
            </form>
        </li>
    </ul>
</div>


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