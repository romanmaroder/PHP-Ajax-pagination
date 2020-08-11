<?php
require_once 'config/config.php';
require_once 'db/db.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Комментарии</title>
	<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="wrapper">
	<h1>Комментарии</h1>

	<!--	Блок пагинации-->
	<div>
        <?php if (!empty($page_count)) : ?>
			<nav>
				<ul class="pagination">

					<li class='prev' >
						<a  href=""  aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
						</a>
					</li>

                    <?php for ($i = 1; $i <= $page_count; $i++) {
                        if ($page == $i) {
                            $class = 'class="active"';
                        } else {
                            $class = '';
                        }
                        echo "<li $class data-id='$i'><a  class='page-link' href='page=$i'>$i</a></li>";
                    }; ?>

					<li class='next' >
						<a href="" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
						</a>
					</li>

				</ul>
			</nav>
        <?php endif;; ?>
	</div>
	<!--	// Блок пагинации-->

	<!--	Блок вывода комментариев-->
	<div class="note">
        <?php foreach ($messages as $message): ?>
			<p>
				<time class="date"><?php echo date('d.m.y H:s:i', strtotime($message['date'])); ?></time>
				<span class="name"><?php echo $message['name']; ?></span>
			</p>
			<p><?php echo $message['message']; ?></p>
        <?php endforeach; ?>
	</div>
	<!--	// Блок вывода комментариев-->

	<!--	Блок вывода сообщений об успехе или ошибках-->
    <?php if (isset($_REQUEST['comment']) && empty($errors)) : ?>

		<div class="info alert alert-success">
			Комментарий сохранен!
		</div>

    <?php elseif (empty($messages)): ?>

		<div class="info alert alert-info">
            <?php echo $no_comment; ?>
		</div>

    <?php endif; ?>

    <?php if (!empty($errors)) : ?>
        <?php echo "<div class='info alert alert-danger'>"; ?>

        <?php foreach ($errors as $error) {
            echo $error . '<br>';
        }; ?>

        <?php echo " </div > "; ?>

    <?php endif; ?>
	<!--	// Блок вывода сообщений об успехе или ошибках-->

	<!--	Форма для добавления комментариев-->
	<div id="form">
		<form action="index.php" method="POST">
			<p><input class="form-control" name="name" placeholder="Ваше имя" value="<?php echo $name; ?>"></p>
			<p><textarea class="form-control" name="message" placeholder="Ваш отзыв"></textarea></p>
			<p><input type="submit" name="comment" class="btn btn-info btn-block" value="Оставить отзыв"></p>
		</form>
	</div>
	<!--	// Форма для добавления комментариев-->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>










