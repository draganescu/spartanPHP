spartanPHP
==========


Spartan is a helper for more lean web development.
--------------------------------------------------

The working principle is really simple:


1. all the frontend is made of html pages
2. all the backend is made of php objects
3. the html pages have some html comments that pull dynamic data from the php objects


For example say you want to display a cooking recipe in a page. Its really easy:


```html
<html>
<body>
	<!-- render.recipes.the_recipe -->
	<h1>
		<!-- print.title -->Some recipe title<!-- /print.title -->
	</h1>
	<h2>
		<!-- print.name -->Author Name<!-- /print.name -->
		<!-- print.@href.author_link -->
		<a href='http://example.com'>Author Name's website -></a>
		<!-- /print.@href.author_link -->
	</h2>
	<p>
		<!-- print.description -->
		The recipe description Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod	tempor incididunt ut labore et dolore magna aliqua.
		<!-- /print.description -->
	</p>
	<h3>Ingredients</h3>
	<ul>
		<!-- print.ingredients -->
		<li>
			<!-- print.ingredient -->
			Item 1
			<!-- /print.ingredient -->
			<!-- print.qty -->
			20 oz
			<!-- /print.qty -->
		</li>
		<!-- /print.ingredients -->
		<!-- remove -->
		<li>Item 2</li>
		<li>Item 3</li>
		<li>Item 4</li>
		<!-- /remove -->
	</ul>
	<!-- /render.recipes.the_recipe -->

</body>
</html>
```

on the server side you'd have a simple php class that looks in the db and gets the recipe. You need to return an array of data:

```PHP
<?php 
	class recipes
	{
		function the_recipe()
		{
			// get the recipe from the db
			// ...

			// lets say we dont have a db
			return array(
					array(
						"title"=>"Chocolate cake",
						"name"=>"Mark Markuson",
						"author_link"=>"http://markusoncooking.com",
						"description"=>"Best cake you've ever had",
						"ingredients"=>array(
								array(
									"ingredient"=>"chocolate",
									"qty"=>"40 oz"
								),
								array(
									"ingredient"=>"milk",
									"qty"=>"80 oz"
								)
							)
					)
				)
		}
	}
	
?>
```

Aside from this MVC pull structure Spartan offers some other features to help you implement web applications in an easy manner:

 - form handling with custom validation, auto table management for CRUD or auto form filling with data
 - a nice way of managing database querries with no orm but with an object oriented approach
 - support for custom routing 
 - partials to keep your app dry






