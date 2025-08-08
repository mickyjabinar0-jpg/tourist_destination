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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact Us</title>
  <style>

    body {
      font-family: Arial, sans-serif;
      background: white;
      color: #444;
      margin: 0;
      padding: 0;
       background-image: url('https://storage.pixteller.com/designs/designs-images/2019-03-27/05/love-and-passion-background-backgrounds-love-1-5c9b994ec8376.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
      } 
        .navbar{
          background-color: hotpink;}
           .topnav a {
            float: left;
            color: white;
           text-align: center;
            padding: 50px;
            text-decoration: none;
            text-shadow: black;
        }

        .navbar{
          background-color: hotpink;
        }
        .topnav a:hover {
            background-color: black;
        }
        .topnav a.pull-right{
            float: right;
            
        }
        .active {
            background-color:whitesmoke;
        }
        .container {
        border: 1px solid hotpink;
        width: 50%;
        margin: auto;
        }
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
      max-width: 350px;
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
      height: 80px;
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
</head>
<body>

          <div class="navbar">
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
               <div class="logo"><b>✈︎Tourism Destination</b></div>
              <li><a href="home.php">Home</a></li>
              <li class="active"><a href="contact.php">Contact</a></li>
              <li><a href="services.php">Services</a></li>
              <li style="float:right"><a href="login_page.php">Login</a></li>
            </ul>
          </div>
        </div>
      </nav>

<?php if (!empty($msg)): ?>
  <p class="<?php echo (strpos($msg, 'successfully') !== false) ? 'success-msg' : 'error-msg'; ?>">
    <?php echo htmlspecialchars($msg); ?>
  </p>
<?php endif; ?>

<div class="contact-container">
  <div class="contact-text">
    <h2>Contact Us!!!</h2>
    <p>Send us an enquiry, or rate us! By sending with us your feedback we can improve our services tailored with your needs.</p>
  </div>

  <form action="contact.php" method="POST">
    <input type="text" name="name" placeholder="Name (optional)" />
    <textarea name="message" placeholder="Message/Feedback" required></textarea>
    <input type="email" name="email" placeholder="Email" required />
    <input type="text" name="contact" placeholder="Contact Number" />
    <button type="submit">Send</button>
    <small>By clicking Send, you agree to the terms of use.</small>
  </form>
</div>
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
 <div class="vc_row-full-width vc_clearfix"></div></div><div class="row-wrapper  id_1688185f83dc9e1830176658 "><div class=""><div class="large-12 columns"><div class="vc_column-inner "><div class="wpb_wrapper">	<div class="vc_empty_space">
		<span class="vc_empty_space_inner"></span>
		<div class="" style="height: 50px"></div>
			</div>
</div>
</div>
</div>
</div>
	<body>
  <footer><center>
	<div class="footer">
        <hr class="featurette-divider">
        <div class="row">
                <div class="col-lg-4">
                  <!--<svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>-->
                  <img  src="https://scontent.fceb6-4.fna.fbcdn.net/v/t39.30808-6/518162859_1046222620985377_7536121654242157176_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=a5f93a&_nc_eui2=AeHtSOTwjkWFwtX5lLpDC-r3gWLZAefk_QqBYtkB5-T9CveWjFh3yb0bUQhlYnqJxfl2S-BC-PmhWufIL4SWzCVD&_nc_ohc=ZUgpbdd3ZPkQ7kNvwHdWj7k&_nc_oc=AdlB2br0Yw2pQf9_Zup1PL5sxvWwxZG4R1KASnjYyrSVHl2gtciM2rxQf_UW8ArzZZI&_nc_zt=23&_nc_ht=scontent.fceb6-4.fna&_nc_gid=YViBeh2-yIQEY597m0fE_g&oh=00_AfRX05mrLJkvnmC6_sVCuo9-o20mPgIaLqVjm5HzKs0wOw&oe=688CA434" width ="150"  height="150" class="img-circle" alt="Cinque Terre">
                  <h1 style="color: hotpink ;font-size:20px"><b>Jovanna Petito</b></h1>  
                  <p><b>Founder</b></p>
                  <p> A person who establishes or creates something new, such as a company, organization, or movement.</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                  <!--<svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>-->
                  <img  src="https://scontent.fceb6-1.fna.fbcdn.net/v/t39.30808-6/494904943_709026738354670_6688066168037716283_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=cc71e4&_nc_eui2=AeGinuqrqNM2dDYK27KZAfjeqTkIo42H552pOQijjYfnnXt56Q-flOmeNOGxwBEr4mJ2wCXk8AMdxFOmZbQA7vmh&_nc_ohc=7JtKJ41u9eYQ7kNvwGaGsdp&_nc_oc=Adn71ohqOYup73k6NNNcMEVbPu535v6KQzoVYkg7J2dkOdLKrLIripuevCcS2YysQqs&_nc_zt=23&_nc_ht=scontent.fceb6-1.fna&_nc_gid=DmiRUwq_cRduqscexefb8w&oh=00_AfQOMRtz5PU7LWksE-AhqNP9ucrpLumgwwPka3F2YYnaCg&oe=688DF081" width ="150"  height="150" class="img-circle" alt="Cinque Terre">
                 <h1 style="color: hotpink ;font-size:20px"><b>Nath Augury Alvarado</b></h1>  
                  <p><b>Executive Director</b></p>
                  <p> A senior-level manager who leads and oversees the operations of an organization.</p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                  <!--<svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"></rect><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>-->
                  <img src="https://scontent.fceb2-2.fna.fbcdn.net/v/t39.30808-6/524172305_1080445137510803_7636828681874666329_n.jpg?stp=dst-jpg_p526x296_tt6&_nc_cat=107&ccb=1-7&_nc_sid=833d8c&_nc_eui2=AeFaplo-YOxgvFRnwC4_vPsINF7g-RrfIDU0XuD5Gt8gNRFSWKV-VFjgWMjNCv4dpjLMO5ZokZ3QqugxiaDXhDms&_nc_ohc=JP6hE_tO3XcQ7kNvwGhLaJe&_nc_oc=AdltV7-XjLBtb2mRnrYZZoHvQKrdstIsNoM9T_tnWzKrw0ixojVZIgK68DZLwc3Smuo&_nc_zt=23&_nc_ht=scontent.fceb2-2.fna&_nc_gid=U55VSvGfSfjxaQXq4AiYSw&oh=00_AfQY4lZh6o5ijKlMx2W6BdpGReoc9EJmJ4bcHlcSksGbrg&oe=688C9B9B" width ="150"  height="150" class="img-circle" alt="Cinque Terre">
                 <h1 style="color: hotpink ;font-size:20px"><b>Mikay Jabiñar</b></h1>  
                  <p><b>Manager</b></p>
                  <p>Leading, organizing, and guiding a team to achieve organizational goals. </p>
                </div><!-- /.col-lg-4 -->
				<p class="float-left"><a href="#">Back to top</a></p>
          </div>
    </center>

  </div>
  </footer>
</body>
</html>