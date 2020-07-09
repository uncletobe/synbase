<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style type="text/css">
    	.svg-block {
    		display: none;
    	}
        .login-form-block {
            padding-top: 30px;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .a-logout:hover {
        	text-decoration: none;
        }
        .syn-line, 
        .syn-line-form {
        	background-color: #f8f9fa;
        	border-radius: 5px;
        	padding: 10px 25px;
        	/*padding-left: 30px;*/
        	line-height: 36px;
        }
        .add {
        	padding-right: 5px;
        	font-size: 24px;
        }

		.syn-line:not(:first-child), 
		.syn-line-form {
			margin-top: 20px;
			margin-bottom: 20px;
		}
		.word {
			font-weight: bold;
			color: black;
			padding-right: 25px;
		}
		.syn {
			color: gray;
		}
		.syn:not(:last-child) {
			padding-right: 25px;
		}
		.add-syn:hover,
		.syn-line:hover {
			background-color: aliceblue;
			cursor: pointer;
			transition: 0.3;
		}
		svg {
			height: 20px;
			width: 20px;
		}
		.add svg {
			fill: gray;
		}
		.status-svg {
			float: right;
		}
		#svg-clock {
			color: #007BFF;
		}
		#svg-exclamation {
			color: red;
		}
		#svg-ok {
			color: green;
		}
    </style>
</head>
<body>
<div class="svg-block">
	<svg id="svg-plus" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/></svg>
	<svg id="svg-ok" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="check-circle" class="svg-inline--fa fa-check-circle fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm0 48c110.532 0 200 89.451 200 200 0 110.532-89.451 200-200 200-110.532 0-200-89.451-200-200 0-110.532 89.451-200 200-200m140.204 130.267l-22.536-22.718c-4.667-4.705-12.265-4.736-16.97-.068L215.346 303.697l-59.792-60.277c-4.667-4.705-12.265-4.736-16.97-.069l-22.719 22.536c-4.705 4.667-4.736 12.265-.068 16.971l90.781 91.516c4.667 4.705 12.265 4.736 16.97.068l172.589-171.204c4.704-4.668 4.734-12.266.067-16.971z"/>
	</svg>
	<svg id="svg-clock" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="far" data-icon="clock" class="svg-inline--fa fa-clock fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/>
	</svg>
	<svg id="svg-exclamation" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-circle" class="svg-inline--fa fa-exclamation-circle fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zm-248 50c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z"/>
	</svg>
</div>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="/">
        JcBaza.ru
    </a>
	<div>
		<a class="a-logout" href="/logout">
			<span class="navbar-text pr-1">{{ Auth::user() }}</span>
	    		<svg xmlns="http://www.w3.org/2000/svg" height="22px" color="gray" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sign-out-alt" class="svg-inline--fa fa-sign-out-alt fa-w-16" role="img" viewBox="0 0 512 512"><path fill="currentColor" d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"/></svg>
	    	</a>
    </div>
</nav>
<div class="container">
    <div class="row d-flex justify-content-center">
    	<div class="col-8 mt-5">
    		<div class="col-8">
	    		<div class="syn-line add-syn">
	    			<span class="add">
	    			<svg>
                        <use xlink:href="#svg-plus" />
                    </svg>
	    			</span>
	    			Добавить список синонимов
	    		</div>
	    		<div class="syn-line-form">
	    			<h5 class="syn-form">Новый список синонимов</h5>
					<form>
					  <div class="form-group">
					    <input type="text" name="word" class="form-control" placeholder="Введите слово">
					  </div>
					  <div class="form-group">
					    <input type="text" name="synonym" class="form-control" placeholder="Введите синоним">
					  </div>
					  <div class="text-right">
					  	<button class="btn btn-light">Отмена</button>
					  	<button class="btn btn-primary">Отправить</button>
					  </div>
					</form>
	    		</div>
	    		<div class="syn-line">
	    			<span class="word">Мопед</span>
	    			<span class="syn">Дырчик</span>
	    			<span class="syn">Моцык</span>
	    			<span class="syn">Мотик</span>
	    			<span class="status-svg">
	    				<svg>
	                        <use xlink:href="#svg-clock" />
	                    </svg>
	    			</span>
	    		</div>
	    		<div class="syn-line">
	    			<span class="word">Toyota</span>
	    			<span class="syn">Таёта</span>
	    			<span class="syn">Таута</span>
	    			<span class="syn">Тоета</span>
	    			<span class="status-svg">
	    				<svg>
	                        <use xlink:href="#svg-ok" />
	                    </svg>
	    			</span>
	    		</div>
	    		<div class="syn-line">
	    			<span class="word">Кран</span>
	    			<span class="syn">Кранчик</span>
	    			<span class="syn">Смеситель</span>
	    			<span class="status-svg">
	    				<svg>
	                        <use xlink:href="#svg-clock" />
	                    </svg>
	    			</span>
	    		</div>
	    		<div class="syn-line">
	    			<span class="word">Ляляля</span>
	    			<span class="syn">Тополя</span>
	    			<span class="syn">Три рубля</span>
	    			<span class="status-svg">
	    				<svg>
	                        <use xlink:href="#svg-exclamation" />
	                    </svg>
	    			</span>
	    		</div>
	    	</div>	
    	</div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>