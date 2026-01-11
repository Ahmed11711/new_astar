<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
</head>
<body>
<h2>Payment Successful</h2>

<script>
    // Send data to parent page (iframe)
    window.parent.postMessage(@json($data), '*');
</script>
</body>
</html>
