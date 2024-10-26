<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Evaluation System</title>
<style>
body {
  margin: 0;
  padding: 0;
  font-family: 'Poppins', sans-serif;
  color: #333;
  background: #f5f5f5;
}

.background-image {
  background: linear-gradient(135deg, #ffffff, #f0f0f0);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  padding: 20px;
  box-sizing: border-box;
}

.header-container {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}

.header-container img {
  max-width: 100px;
  margin-right: 20px;
}

h1 {
  font-size: 3em;
  color: #333;
  text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.3);
  text-align: center;
  margin: 0;
}

.card-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  width: 90%;
  max-width: 1200px;
  margin: 20px auto;
  padding: 20px;
  box-sizing: border-box;
}

.text-card {
  text-decoration: none;
  color: #333;
  border: 2px solid transparent;
  border-radius: 12px;
  overflow: hidden;
  transition: all 0.3s ease;
  background: #ffffff;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 20px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.text-card:hover {
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
  transform: translateY(-5px);
  border-color: #3f51b5;
}

.card-content {
  text-align: center;
}

.card-content h2 {
  margin: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.3em;
  color: #333;
}

.card-content h2 i {
  margin-right: 10px;
  font-size: 1.3em;
}

.logout-container {
  margin-top: 20px;
  text-align: center;
}

.logout-button {
  padding: 8px 16px;
  font-size: 14px;
  color: white;
  background-color: #d9534f;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
  margin-top: 20px;
}

.logout-button:hover {
  background-color: #c9302c;
  transform: translateY(-2px);
  box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
}

.logout-button:active {
  background-color: #ac2925;
  transform: translateY(0);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<div class="background-image">
  <div class="header-container">
    <img src="/public/img/psulogo.png" alt="Course Evaluation System">
    <h1>Course Evaluation System</h1>
  </div>

  <?php if ($_SESSION['user_type'] == "Admin") { ?>
    <div class="card-container">
      <a href="/studentgrades" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-graduation-cap"></i> Course Evaluation</h2>
        </div>
      </a>
      <a href="/courses" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-book"></i> Course</h2>
        </div>
      </a>
      <a href="/subjects" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-book-open"></i> Subject</h2>
        </div>
      </a>
      <a href="/curriculums" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-chalkboard-teacher"></i> Curriculum</h2>
        </div>
      </a>
      <a href="/users" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-user"></i> Users</h2>
        </div>
      </a>
      <a href="/students" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-user-graduate"></i> Students</h2>
        </div>
      </a>
      <a href="/preenroll" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-tasks"></i> Course Checking</h2>
        </div>
      </a>
      <a href="/schoolyears" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-calendar-alt"></i> School Years</h2>
        </div>
      </a>
      <a href="/semesters" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-calendar"></i> Semesters</h2>
        </div>
      </a>
      <a href="/settings" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-cog"></i> Account Settings</h2>
        </div>
      </a>
      <a href="/out" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-sign-out-alt"></i> Log Out</h2>
        </div>
      </a>
    </div>
  <?php } elseif ($_SESSION['user_type'] != "Student") { ?>
    <div class="card-container">
      <a href="/studentgrades" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-graduation-cap"></i> Course Evaluation</h2>
        </div>
      </a>
      <a href="/students" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-user-graduate"></i> Students</h2>
        </div>
      </a>
      <a href="/preenroll" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-tasks"></i> Course Checking</h2>
        </div>
      </a>
      <a href="/schoolyears" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-calendar-alt"></i> School Years</h2>
        </div>
      </a>
      <a href="/semesters" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-calendar"></i> Semesters</h2>
        </div>
      </a>
      <a href="/settings" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-cog"></i> Account Settings</h2>
        </div>
      </a>
      <a href="/out" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-sign-out-alt"></i> Log Out</h2>
        </div>
      </a>
    </div>
  <?php } elseif ($_SESSION['user_type'] == "Student") { ?>
    <div class="card-container">
      <a href="/myCurriculums" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-clipboard-list"></i> Course Evaluation</h2>
        </div>
      </a>
      <a href="/coursecheck" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-tasks"></i> Course Checking </h2>
        </div>
      </a>
     
      <a href="/settings" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-cog"></i> Account Settings</h2>
        </div>
      </a>
      <a href="/out" class="text-card">
        <div class="card-content">
          <h2><i class="fas fa-sign-out-alt"></i> Log Out</h2>
        </div>
      </a>
    </div>
  <?php } ?>
</div>

</body>
</html>
