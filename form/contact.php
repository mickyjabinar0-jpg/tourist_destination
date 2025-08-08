<?php 
include 'db_connection.php';  
?>

<?php
$msg = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $name = $_POST['name'] ?? '';
  $message = $_POST['message'] ?? '';
  $email = $_POST['email'] ?? '';
  $contact = $_POST['contact'] ?? '';

  $stmt = $conn->prepare("INSERT INTO touristdestination_db (name, message, email, contact_number) VALUES (?, ?, ?, ?)");

  if ($stmt === false) {
    $msg = "Something went wrong: " . htmlspecialchars($conn->error);
  } else {
    $stmt->bind_param("ssss", $name, $message, $email, $contact);
    if ($stmt->execute()) {
      $msg = "Feedback message was sent successfully.";
    } else {
      $msg = "Error sending feedback: " . htmlspecialchars($stmt->error);
    }
    $stmt->close();
  }

  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <title>TOURISM WEBSITE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=6">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .contact-container {
      max-width: 900px;
      margin: 50px auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 40px;
      padding: 0 20px;
    }
    .contact-text {
      flex: 1;
      text-align: center;
    }
    .contact-text h2 {
      font-weight: normal;
      font-size: 2.5rem;
      margin-bottom: 10px;
    }
    .contact-text p {
      font-size: 0.9rem;
      color: #555;
      max-width: 300px;
      margin: 0 auto;
      line-height: 1.3;
    }
    form {
      flex: 1;
      max-width: 500px;
      border: 1px solid #eee;
      padding: 20px;
      background: #fafafa;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }
    form input, form textarea {
      width: 100%;
      padding: 8px 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 3px;
      resize: vertical;
    }
    form textarea {
      height: 100px;
    }
    form button {
      background: #007bff;
      border: none;
      color: white;
      padding: 10px;
      font-size: 1.1rem;
      border-radius: 3px;
      cursor: pointer;
    }
    form button:hover {
      background: #0056b3;
    }
    form small {
      font-size: 0.8srem;
      color: #666;
      margin-top: 5px;
      display: block;
    }
    .success-msg {
      color: green;
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
    }
    .error-msg {
      color: red;
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
    }
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}
body  {
  background-image: url("https://storage.pixteller.com/designs/designs-images/2019-03-27/05/love-and-passion-background-backgrounds-love-1-5c9b994ec8376.png");
  background-color:rgb(204, 204, 204);
}
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 15px;
  resize: vertical;
}

input[type=submit] {
  background-color:rgba(170, 4, 26, 0.74);
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color:rgb(69, 160, 69);
}

.container {
  border-radius: 5px;
  background-color:rgba(242, 242, 242, 0);
  padding: 20px;
}
body {font-family: Arial, Helvetica, sans-serif;}

.navbar {
  width: 100%;
  background-color: hotpink;
  overflow: auto;
}

.navbar a {
  float: left;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background-color: #000;
}


@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}
 form small {
      font-size: 0.7rem;
      color: #666;
      margin-top: 5px;
      display: block;
    }
    .success-msg {
      color: green;
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
    }
    .error-msg {
      color: red;
      text-align: center;
      margin-top: 20px;
      font-weight: bold;
    }
  </style>

<body>


<nav> 
  <div class="navbar">
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
               <div class="logo"><b>✈︎Tourism Destination</b></div>
              <li ><a href="home.php">Home</a></li>
              <li class="active"><a href="contact.php">Contact</a></li>
              <li><a href="services.php">Services</a></li>
              <li style="float:right"><a href="login_page.php">Login</a></li>
            </ul>
          </div>
        </div>
      </nav>
         
</body>
</html>

<main role="main" class="container">
			<!-- kailangan ini didto hit footer end tag div -->
			<div class="container marketing">
			<div class="container col-xl-10 col-xxl-8 px-4 py-5">
				<div class="row align-items-center g-lg-5 py-5">
					<div class="col-lg-7 text-center text-lg-start">
						<h1 class="display-4 fw-bold lh-1 mb-3"><b>Contact Us!!!</b></h1>
						<p class="col-lg-10 fs-4">Send us an enquiry, or rate us! By sending with us your feedback we can improve our services talored with your needs.</p>
					</div>
          <?php if (!empty($msg)):
             ?>
          <p class="<?php echo (strpos($msg, 'successfully') !== false) ? 'success-msg' : 'error-msg'; ?>">
          <?php echo htmlspecialchars($msg); ?>
           </p>
          <?php endif; ?>
	        <script>
          document.addEventListener('DOMContentLoaded', function () {
          const msgBox = document.querySelector('.success-msg, .error-msg');
           if (msgBox) {
            setTimeout(() => {
            msgBox.style.display = 'none';
           }, 3000);
         }
       });
  </script>
  <form action="contact.php" method="POST">
    <input type="text" name="name" placeholder="Name (optional)" />
    <textarea name="message" placeholder="Message/Feedback" required></textarea>
    <input type="email" name="email" placeholder="Email" required />
    <input type="text" name="contact" placeholder="Contact Number" />
    <button type="submit">Send</button>
    <small>By clicking Send, you agree to the terms of use.</small>
  </form>
					</div>
				</div>
			</div>
		
   <div class="vc_row-full-width vc_clearfix">
   </div>
  </div>
  <div class="row-wrapper  id_1688185f83dc9e1830176658 ">
    <div class=""><div class="large-12 columns">
      <div class="vc_column-inner ">
        <div class="wpb_wrapper">	
          <div class="vc_empty_space">
		<span class="vc_empty_space_inner"></span>
		<div class="" style="height: 50px"></div>
			</div>
</div>
</div>
</div>
</div>
  <footer><center>
	<div class="footer">
        <hr class="featurette-divider">
        <div class="row">
                <div class="col-lg-4">
                  <!--<svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>-->
                  <img  src="https://scontent.fceb6-4.fna.fbcdn.net/v/t39.30808-6/518162859_1046222620985377_7536121654242157176_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeHtSOTwjkWFwtX5lLpDC-r3gWLZAefk_QqBYtkB5-T9CveWjFh3yb0bUQhlYnqJxfl2S-BC-PmhWufIL4SWzCVD&_nc_ohc=0uyR9N2ooD4Q7kNvwHASkbT&_nc_oc=Adnu3ll2yl44w9J8MoJhmbJ6TYIMKQ1uoZ1VAjo9v-6PBji9vrBkA1qJ1G8JmFOkQto&_nc_zt=23&_nc_ht=scontent.fceb6-4.fna&_nc_gid=ORL-6ogz16XS28vGDHBTag&oh=00_AfWPfAA6PMeW4nmu8ObRbHggetzc7H1BqkNHz271_dbYJA&oe=68964F34" width ="150"  height="150" class="img-circle" alt="Cinque Terre">
                  <h1 style="color: hotpink ;font-size:20px"><b>Jovanna Petito</b></h1>  
                  <p><b>Founder</b></p>
                  <p> A person who establishes or creates something new, such as a company, organization, or movement.</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                  <!--<svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>-->
                  <img  src="https://scontent.fceb6-1.fna.fbcdn.net/v/t39.30808-6/494904943_709026738354670_6688066168037716283_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=cc71e4&_nc_eui2=AeGinuqrqNM2dDYK27KZAfjeqTkIo42H552pOQijjYfnnXt56Q-flOmeNOGxwBEr4mJ2wCXk8AMdxFOmZbQA7vmh&_nc_ohc=bbNZX5UXTqkQ7kNvwEpjz2p&_nc_oc=Adn6MHBdowBhzCNz3BWuXSaXK33mQVIFx6SWV2WOZZXns_w8SldzHFadXnGJ2zxZkM8&_nc_zt=23&_nc_ht=scontent.fceb6-1.fna&_nc_gid=_TCVKb9yr7jd8h3B-jTnKw&oh=00_AfVEgTh0V2SKhGdLPJfOOEsdmutuwaQhgNdtPfsVKHfCZQ&oe=68964A01" width ="150"  height="150" class="img-circle" alt="Cinque Terre">
                 <h1 style="color: hotpink ;font-size:20px"><b>Nath Augury Alvarado</b></h1>  
                  <p><b>Executive Director</b></p>
                  <p> A senior-level manager who leads and oversees the operations of an organization.</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                  <!--<svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>-->
                  <img src="https://scontent.fceb2-2.fna.fbcdn.net/v/t39.30808-6/524172305_1080445137510803_7636828681874666329_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFaplo-YOxgvFRnwC4_vPsINF7g-RrfIDU0XuD5Gt8gNRFSWKV-VFjgWMjNCv4dpjLMO5ZokZ3QqugxiaDXhDms&_nc_ohc=6HQHdTmRufwQ7kNvwFCmz_6&_nc_oc=Adm0-94NNEJ9vmgfBf63fm_vbQYTfSgYhtdxpC_7tl15N9nZ-j6nHru344GbFBeqwAg&_nc_zt=23&_nc_ht=scontent.fceb2-2.fna&_nc_gid=0r8yQgiY1e_pYMTb-gFlsA&oh=00_AfXh2d5wKkqrwTsaU1m_DZCFP8VBvQ_rdNrivAku4fFBDg&oe=6896469B" width ="150"  height="150" class="img-circle" alt="Cinque Terre">
                 <h1 style="color: hotpink ;font-size:20px"><b>Mikay Jabiñar</b></h1>  
                  <p><b>Manager</b></p>
                  <p>Leading, organizing, and guiding a team to achieve organizational goals. </p>
                </div><!-- /.col-lg-4 -->
				<p class="float-left"><a href="#">Back to top</a></p>
          </div>

</body>
</html>