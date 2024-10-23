<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <!-- Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    </head>
    <style>
        h2 {
    font-size: 26px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
  }
  
  form {
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
  }
  
  .form-group {
    margin-bottom: 20px;
  }
  
  .form-group label {
    font-size: 14px;
    color: #666;
    display: block;
    margin-bottom: 8px;
  }
  
  .form-group input {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s ease;
  }
  
  .form-group input:focus {
    border-color: #007bff;
    outline: none;
  }
  
  button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  
  p {
    font-size: 14px;
    text-align: center;
    color: #777;
    margin-top: 15px;
  }
  
  .router-link {
    color: #007bff;
    text-decoration: none;
  }
  
  .router-link:hover {
    text-decoration: underline;
  }
  
  /* Responsive adjustments */
  @media (max-width: 480px) {
    form {
      padding: 20px;
      width: 90%;
    }
  
    button {
      font-size: 14px;
    }
  }
    </style>
    <body>
            <div id="app"></div>
    </body>
    <script src="{{ mix('/js/app.js') }}"></script>
</html>
