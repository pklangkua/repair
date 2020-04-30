<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">       
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
    <body>

        Name: <input id="hint" />

        <script type="text/javascript">

            $("#hint").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "getMedicineNames.php",
                        dataType: "jsonp",
                        data: {
                            name: request
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                minLength: 3
            });

        </script>
    </body>
</html>