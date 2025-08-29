<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tabel</title>
    <style>
        body {
            background-color: SkyBlue;
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 60%;
            margin: 30px auto;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #1E90FF;
            color: white;
            font-size: 18px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #d1e7ff;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>NIM</th>
            <th>Nama</th>
            <th>Umur</th>
        </tr>
        <?php
        $i = 1;
        while ($i <= 10) {
            ?>
            <tr>
                <td>072</td>
                <td>Ersya</td>
                <td>19</td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
</body>

</html>