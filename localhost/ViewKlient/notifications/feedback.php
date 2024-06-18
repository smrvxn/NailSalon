<?php
session_start();

if(empty($_SESSION['IdKlient']))
{
    header('Location: ../login.php');
    exit;
}

// Подключение к базе данных
include_once '../../config.php';

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../styleKlients.css" type="text/css" />
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
		<title>Manicure for you</title>
	</head>
	<body>
		<header class="head_main">
			<div class="text_head">
				<p><a href="../main_page.php">MANICURE FOR YOU</a></p>
			</div>

			<div class="buttons_head">
				<a href="notification.php"><img class="notImg" src="../../images/notification.png"></a>
				<?php
				// Проверка, активна ли сессия
				if (isset($_SESSION["IdKlient"])) {
				    // Пользователь авторизован, выводим кнопку "Выйти"
				    echo '<button class="button1_head"><a href="../KlientAccount/accountMain.php">Аккаунт</a></button>';
				} else {
				    // Пользователь не авторизован, выводим кнопку "Авторизация"
				    echo '<button class="button1_head"><a href="../login.php">Войти</a></button>';
				}
				?>
				<div class="button2_head">
					<ul class="head_menu">
						<li class="text_button_head"><a href="">Меню</a>
							<ul >
								<li class="text_button_head"><a href="../about_we.php">О нас</a></li>
								<li class="text_button_head"><a href="../services.php">Услуги</a></li>
								<li class="text_button_head"><a href="../price.php">Прайс</a></li>
								<li class="text_button_head"><a href="../commands.php">Команда</a></li>
								<li class="text_button_head"><a href="../worksPage.php">Работы</a></li>
								<?php
									if (isset($_SESSION["IdKlient"])) {
									    echo '<li class="text_button_head"><a href="../requareKlient/requareKlient.php">Запись онлайн</a></li>';
									}
								?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</header>

		<main>
			<div class="feedKlientMain">
				<div class="feedKlientContainer">
					<p class='feedKlientText'>Отзыв об услуге</p>

					<?php
					// Получение IdRequest из $_POST
					$requestId = isset($_GET['requestId']) ? $_GET['requestId'] : null;

					if ($requestId) {
				    $sql = "SELECT COUNT(*) AS count FROM Feedback WHERE IdRequest = $requestId";
				    $result = $conn->query($sql);
				    $row = $result->fetch_assoc();
				    if ($row['count'] > 0) {
				        echo "<p class='feedKlientText'>Вы уже оставили отзыв</p>";
				        exit;
					    }
					}

					// Если отзыв еще не оставлен, выводим форму
					if ($requestId) {
					    ?>
					    <div class="feedContainer">
						    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="fromColumn">
						        <input type="hidden" name="requestId" value="<?= $requestId ?>">

						        <p class="feedHeadTxt1">Оцените мастера от 1 до 5</p>

						        <div class="stars" data-rating="0">
						            <i class="fa fa-star fa-3x" data-rating="1"></i>
						            <i class="fa fa-star fa-3x" data-rating="2"></i>
						            <i class="fa fa-star fa-3x" data-rating="3"></i>
						            <i class="fa fa-star fa-3x" data-rating="4"></i>
						            <i class="fa fa-star fa-3x" data-rating="5"></i>
						        </div>

						        <input type="hidden" name="masterFeedback" id="masterFeedback" value="0">

						        <p class="feedHeadTxt1">Комментарий</p>
						        <textarea class="commentText" name="comment" id="comment" placeholder="Не обязательно"></textarea><br><br>

						        <input class="feedNextButton" type="submit" value="Оставить отзыв">
						    </form>
						</div>

					    <?php
					}

					// Обработка отправки формы
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					    $requestId = $_POST['requestId'];
					    $masterFeedback = $_POST['masterFeedback'];
					    $comment = isset($_POST['comment']) ? $_POST['comment'] : "0"; // Если поле пустое, то Comment = 0

					    // Подготовка и выполнение запроса
					    $sql = "INSERT INTO Feedback (IdRequest, MasterFeetback, Comment)
					            VALUES ($requestId, $masterFeedback, '$comment')";
					    if ($conn->query($sql) === TRUE) {
					        echo "<p class='feedKlientText'>Отзыв добавлен успешно</p>";
					    } else {
					        echo "<p class='feedKlientText'>Ошибка добавления отзыва: " . $conn->error . "</p>";
					    }
					}
				?>
				</div>
			</div>
		</main>

		<script>
	    const stars = document.querySelector('.stars');
	    const masterFeedback = document.getElementById('masterFeedback');

	    stars.addEventListener('mouseover', function(e) {
	        const target = e.target;
	        const rating = parseInt(target.dataset.rating);
	        if (rating) {
	            stars.querySelectorAll('i').forEach((star, index) => {
	                if (index < rating) {
	                    star.classList.add('active');
	                } else {
	                    star.classList.remove('active');
	                }
	            });
	        }
	    });

	    stars.addEventListener('mouseout', function(e) {
	        const rating = parseInt(masterFeedback.value);
	        stars.querySelectorAll('i').forEach((star, index) => {
	            if (index < rating) {
	                star.classList.add('active');
	            } else {
	                star.classList.remove('active');
	            }
	        });
	    });

	    stars.addEventListener('click', function(e) {
	        const target = e.target;
	        const rating = parseInt(target.dataset.rating) || 0;
	        masterFeedback.value = rating;
	        stars.querySelectorAll('i').forEach((star, index) => {
	            if (index < rating) {
	                star.classList.add('active');
	            } else {
	                star.classList.remove('active');
	            }
	        });
	    });
	</script>
	</body>
</html>