<?php
// Начинаем сессию
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styleKlients.css" type="text/css" />
	<title>Manicure for you</title>
</head>
<body>
	<header class="head_main">
		<div class="text_head">
			<p><a href="main_page.php">MANICURE FOR YOU</a></p>
		</div>

		<div class="buttons_head">

			<a href="notifications/notification.php"><img class="notImg" src="../images/notification.png"></a>

			<?php

			// Проверка, активна ли сессия
			if (isset($_SESSION["IdKlient"])) {
			    // Пользователь авторизован, выводим кнопку "Выйти"
			    echo '<button class="button1_head"><a href="KlientAccount/accountMain.php">Аккаунт</a></button>';
			} else {
			    // Пользователь не авторизован, выводим кнопку "Авторизация"
			    echo '<button class="button1_head"><a href="login.php">Войти</a></button>';
			}

			?>

			<div class="button2_head">
				<ul class="head_menu">
					<li class="text_button_head"><a href="main_page.php">Меню</a>
						<ul >
							<li class="text_button_head"><a href="about_we.php">О нас</a></li>
							<li class="text_button_head"><a href="services.php">Услуги</a></li>
							<li class="text_button_head"><a href="price.php">Прайс</a></li>
							<li class="text_button_head"><a href="commands.php">Команда</a></li>
							<li class="text_button_head"><a href="worksPage.php">Работы</a></li>
							<?php
								if (isset($_SESSION["IdKlient"])) {
								    echo '<li class="text_button_head"><a href="requareKlient.php">Запись онлайн</a></li>';
								}
							?>

						</ul>
					</li>
				</ul>
			</div>
		</div>
	</header>

	<main>
		<div class="worksPageMain">
			<div class="image-grid">
		        <?php
		        $dir = '../worksImages/'; // Путь к папке с изображениями
		        $files = array_diff(scandir($dir), array('.', '..'));

		        foreach ($files as $file) {
		            echo '<img src="' . $dir . $file . '" alt="' . $file . '" class="image-item">';
		        }
		        ?>
		    </div>

		    <div id="myModal" class="modal">
		        <span class="close">&times;</span>
		        <div class="modal-content">
		            <img id="modal-image" src="" alt="">
		        </div>
		        <div class="zoom-controls">
		            <button onclick="zoomIn()">+</button>
		            <button onclick="zoomOut()">-</button>
		        </div>
		        <div class="modal-controls">
		            <button onclick="showPrevImage()"><</button>
		            <button onclick="showNextImage()">></button>
		        </div>
		    </div>
		</div>
		<script>
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("modal-image");
        var span = document.getElementsByClassName("close")[0];
        var currentZoom = 1;

        document.querySelectorAll(".image-item").forEach(function(img) {
            img.addEventListener("click", function() {
                modal.style.display = "block";
                modalImg.src = this.src;
            });
        });

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function zoomIn() {
            currentZoom += 0.5;
            modalImg.style.transform = `scale(${currentZoom})`;
        }

        function zoomOut() {
            if (currentZoom > 0.5) {
                currentZoom -= 0.5;
                modalImg.style.transform = `scale(${currentZoom})`;
            }
        }

        var currentImageIndex = -1;
        var imageFiles = [];

        document.querySelectorAll(".image-item").forEach(function(img, index) {
            img.addEventListener("click", function() {
                modal.style.display = "block";
                modalImg.src = this.src;
                currentImageIndex = index;
                imageFiles = Array.from(document.querySelectorAll(".image-item")).map(function(img) {
                    return img.src;
                });
            });
        });

        function showPrevImage() {
            currentImageIndex = (currentImageIndex - 1 + imageFiles.length) % imageFiles.length;
            modalImg.src = imageFiles[currentImageIndex];
        }

        function showNextImage() {
            currentImageIndex = (currentImageIndex + 1) % imageFiles.length;
            modalImg.src = imageFiles[currentImageIndex];
        }

    </script>
	</main>
</body>
</html>