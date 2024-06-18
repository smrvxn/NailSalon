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
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">

	<title>manicure for you</title>
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
					<li class="text_button_head"><a href="">Меню</a>
						<ul >
							<li class="text_button_head"><a href="about_we.php">О нас</a></li>
							<li class="text_button_head"><a href="services.php">Услуги</a></li>
							<li class="text_button_head"><a href="price.php">Прайс</a></li>
							<li class="text_button_head"><a href="commands.php">Команда</a></li>
							<li class="text_button_head"><a href="worksPage.php">Работы</a></li>
							<?php
								if (isset($_SESSION["IdKlient"])) {
								    echo '<li class="text_button_head"><a href="requareKlient/requareKlient.php">Запись онлайн</a></li>';
								}
							?>

						</ul>
					</li>
				</ul>
			</div>
		</div>
	</header>

	<main >
		<div class="main_page_main">
			<div class="main_page_container">
				<div class="text_main1">
					<p class="text_main11">Красота</p>
					<p class="text_main12">в каждой</p>
					<p class="text_main13">детали</p>
					<button class="main_button1"><a href="requareKlient/requareKlient.php">Запись онлайн</a></button>
				</div>
				<img class="image_main_page" src="../images/main3.png"/>
			</div>

			<div class="main_page_container1">
				<p class="text_main2">Акции</p>
				<div class="sale_main_container">
					<div class="sale_main">
						<img  src="../images/sale1.png" class="sale_img1" />
						<div class="div_sale1">
							<p class="text_sale1">Скидка 25%</p>
							<p class="text_sale2">в день рождения</p>
							<p class="text_sale21">Для получения скидки, укажите при регистрации дату вашего рождения, в указанный день вам придет письмо с купоном. Для того чтобы воспользоваться купоном, при оплате покажите его администратору или назовите код из уведомления, а также не забудьте паспорт!</p>
						</div>

					</div>
					<div class="sale_main">
						<div class="div_sale1">
							<p class="text_sale3">Скидка 15%</p>
							<p class="text_sale4">на каждое 6 посещение</p>
							<p class="text_sale21">При первом визите к нам Вы получаете карту постоянного клиента, где каждое посещение студии будет отмечаться. После пяти отметок следующая услуга уже будет со скидкой. </p>
						</div>
						<img  src="../images/sale2.png" class="sale_img1" />
					</div>
				</div>
			</div>

			<div class="main_page_container2">
				<p class="text_main3">Почему нас выбирают</p>
				<div class="best_container">
					<div class="best1_container">
						<img class="img_best" src="../images/best1.png">
						<p class="best_text1">Доступность</p>
						<p class="best_text2">Расположение недалеко от центра города</p>
					</div>
					<div class="best1_container">
						<img class="img_best" src="../images/best2.png">
						<p class="best_text1">Цена</p>
						<p class="best_text2">Классический маникюр от 1000 рублей</p>
					</div>
					<div class="best1_container">
						<img class="img_best" src="../images/best3.png">
						<p class="best_text1">Комфорт</p>
						<p class="best_text2">Вы отдыхаете, мы - наводим красоту</p>
					</div>
					<div class="best1_container">
						<img class="img_best" src="../images/best4.png">
						<p class="best_text1">Качество</p>
						<p class="best_text2">Средняя носка покрытия от 3х недель</p>
					</div>
				</div>
			</div>


			<?php
				include_once '../config.php';

				// Получение отзывов из базы данных
				$sql = "SELECT
				                Klient.KlientName,
				                Master.FIO,
				                Master.Image,
				                Feedback.MasterFeetback,
				                Feedback.Comment
				            FROM
				                Feedback
				            JOIN
				                KlientRequest ON Feedback.IdRequest = KlientRequest.IdRequest
				            JOIN
				                Klient ON KlientRequest.IdKlient = Klient.IdKlient
				            JOIN
				                Master ON KlientRequest.IdMaster = Master.IdMaster
				            WHERE
				                Feedback.Comment IS NOT NULL";
				$result = $conn->query($sql);

				// Проверка, есть ли отзывы
				if ($result->num_rows > 0) {
			?>
			<div class="main_page_container3">
				<p class="headTextFeed">Ваши отзывы</p>
				<div class="feedRowContainer">
					<button class="buttonFeed1"><</button>
					<div class="carouselFeedBack">
					        <?php
					        $i = 0;
					        while($row = $result->fetch_assoc()) {
					            $i++;
					            ?>
					            <div class="carouselFeedBack-item <?php if ($i == 1) echo 'active'; ?>">
					                <div class="review">
					                    <div class="RowMasterContainer">
					                    	<img src="../images/people/<?= $row['Image'] ?>" class="masterImageFeed"/>
					                    	<p class="feedMaster">Мастер <?= $row['FIO'] ?></p>
					                    </div>
					                    <div class="RowContainer">
					                		<p class="feedKlient"><?= $row['KlientName'] ?></p>
					                		<div class="stars" data-rating="<?php echo $row['MasterFeetback']; ?>">
					                        <?php
					                        for ($j = 1; $j <= 5; $j++) {
					                            ?>
					                            <i class="fa fa-star <?php if ($j <= $row['MasterFeetback']) echo 'active'; ?>"></i>
					                            <?php
					                        }
					                        ?>
					                        </div>
					                    </div>
					                    <p class="commentTextFeed"><?= $row['Comment'] ?></p>




					                </div>
					            </div>
					            <?php
					        }
					        ?>
					</div>
					<button class="buttonFeed2">></button>
				</div>
			</div>
			<?php } ?>
			<div class="main_page_container4">
				<p class="text_main3">Наши контакты</p>
				<div class="inline_div">
					<div class="main_about">
						<p class="main_about_text">Адрес: г.Екатеринбург, ул.Первомайская 15, офис 322</p>
						<p class="main_about_text">Время работы: ежедневно с 12:00 до 22:00</p>
						<p class="main_about_text">Телефон: 8 (958) 655 11-35</p>
						<p class="main_about_text">Почта: manic_for_u@gmail.com</p>
					</div>
					<div class="soc_seti_about_main">
						<a href="https://t.me/+79920144939"><img class="soc_seti_about_img1" src="../images/tg.png"></a>
						<a href="https://wa.me/89920144939?text=%D0%9F%D1%80%D0%B8%D0%B2%D0%B5%D1%82!%20%F0%9F%91%8B%20%D0%9C%D0%B5%D0%BD%D1%8F%20%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D0%B5%D1%81%D1%83%D0%B5%D1%82..."><img class="soc_seti_about_img1" src="../images/wa.png"></a>
						<a href="https://vk.com/smrwxn"><img class="soc_seti_about_img1" src="../images/vk.png"></a>
					</div>
				</div>
			</div>
		</div>

	</main>

	<script>
	    const carousel = document.querySelector('.carouselFeedBack');
	    const items = carousel.querySelectorAll('.carouselFeedBack-item');
	    const prevBtn = document.querySelector('.buttonFeed1');
	    const nextBtn = document.querySelector('.buttonFeed2');
	    let activeIndex = 0;

	    function showItem(index) {
	        items.forEach((item, i) => {
	            if (i === index) {
	                item.classList.add('active');
	            } else {
	                item.classList.remove('active');
	            }
	        });
	    }

	    nextBtn.addEventListener('click', () => {
	        activeIndex = (activeIndex + 1) % items.length;
	        showItem(activeIndex);
	    });

	    prevBtn.addEventListener('click', () => {
	        activeIndex = (activeIndex - 1 + items.length) % items.length;
	        showItem(activeIndex);
	    });

	    // Инициализация звезд (установка активных классов)
	    const stars = document.querySelectorAll('.stars');
	    stars.forEach(starContainer => {
	        const rating = parseInt(starContainer.dataset.rating);
	        starContainer.querySelectorAll('i').forEach((star, index) => {
	            if (index < rating) {
	                star.classList.add('active');
	            }
	        });
	    });
	</script>
</body>
</html>