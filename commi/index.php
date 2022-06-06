<?php
function url_origin( $s, $use_forwarded_host = false ): string
{
    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );
    $sp       = strtolower( $s['SERVER_PROTOCOL'] );
    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );
    $port     = $s['SERVER_PORT'];
    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;
    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ($s['HTTP_HOST'] ?? null);
    $host     = $host ?? $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function full_url( $s, $use_forwarded_host = false ): string
{
    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];
}

$absolute_url = full_url( $_SERVER, true );
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kommentar System</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/comments.css" rel="stylesheet" type="text/css">
</head>
<body>

<nav class="navtop">
    <div>
        <h1>Test Kommentar System</h1>
    </div>
</nav>

<div class="content home">
    <h2>Artikel XYZ PAGEID: <?= $absolute_url ?></h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tristique vel leo a vestibulum. Praesent varius ex elit, vitae pretium felis laoreet in. Nullam sit amet pretium nulla. Aliquam convallis sem vitae tincidunt pulvinar. Integer id ex efficitur, vulputate ante et, vulputate risus. Maecenas ac nunc est. Donec nisl turpis, aliquet quis turpis mollis, dictum pulvinar est. Vivamus ut suscipit turpis. Sed metus leo, dignissim non vehicula non, tincidunt ac velit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
</div>
<div class="content comments"></div>

<script>
    const comments_page_id = "<?= $absolute_url ?>";
    fetch("comments.php?page_id=" + comments_page_id).then(response => response.text()).then(data => {
        document.querySelector(".comments").innerHTML = data;
        document.querySelectorAll(".comments .write_comment_btn, .comments .reply_comment_btn").forEach(element => {
            element.onclick = event => {
                event.preventDefault();
                document.querySelectorAll(".comments .write_comment").forEach(element => element.style.display = 'none');
                document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "']").style.display = 'block';
                document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "'] textarea[name='content']").focus();
            };
        });
        document.querySelectorAll(".comments .write_comment form").forEach(element => {
            element.onsubmit = event => {
                event.preventDefault();
                fetch("comments.php?page_id=" + comments_page_id, {
                    method: 'POST',
                    body: new FormData(element)
                }).then(response => response.text()).then(data => {
                    element.parentElement.innerHTML = data;
                });
            };
        });
    });
</script>
</body>
</html>