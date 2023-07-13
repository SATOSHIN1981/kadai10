<html>

<head>
    <meta charset="utf-8">
    <title>家事分担を相談しようアンケート</title>
</head>

<body>
    <form action="write.php" method="post"id="myForm">
        お名前: <input type="text" name="name">
        E-mail: <input type="text" name="email">
        <input type="hidden" name="user_id" value="<?php echo isset($_GET['user_id']) ? $_GET['user_id'] : uniqid(); ?>">
        <!-- user_idがURLに入っていないときだけユーザーIDが固有に生成される -->
        <h2>あなたと相手の家事分担の理想の割合を教えてね</h2>
        <label for="q1">掃除の分担は？</label><br>
            <select id="q1" name="q1">
                <option value="1">あなた10割、相手0割</option>
                <option value="2">あなた8割、相手2割</option>
                <option value="3">あなた6割、相手4割</option>
                <option value="4">あなたと相手で半々</option>
                <option value="5">あなた4割、相手6割</option>
                <option value="6">あなた2割、相手8割</option>
                <option value="7">あなた0割、相手10割</option>
                <option value="8">その他</option>
            </select><br>
            
            <label for="q2">洗濯の分担は？</label><br>
            <select id="q2" name="q2">
                <option value="1">あなた10割、相手0割</option>
                <option value="2">あなた8割、相手2割</option>
                <option value="3">あなた6割、相手4割</option>
                <option value="4">あなたと相手で半々</option>
                <option value="5">あなた4割、相手6割</option>
                <option value="6">あなた2割、相手8割</option>
                <option value="7">あなた0割、相手10割</option>
                <option value="8">その他</option>
            </select><br>
            
            <label for="q3">料理の分担は？</label><br>
            <select id="q3" name="q3">
                <option value="1">あなた10割、相手0割</option>
                <option value="2">あなた8割、相手2割</option>
                <option value="3">あなた6割、相手4割</option>
                <option value="4">あなたと相手で半々</option>
                <option value="5">あなた4割、相手6割</option>
                <option value="6">あなた2割、相手8割</option>
                <option value="7">あなた0割、相手10割</option>
                <option value="8">その他</option>
            </select><br>
        <input type="submit" value="送信" onclick="submitForm(); return false;">
    </form>

    <script>
        function submitForm() {
            var form = document.getElementById("myForm");
            form.action = "write.php";
            form.submit();

        }
    </script>

</body>

</html>