<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Base de conhecimento SGBR!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .content h1 {
            margin-top: 0;
            font-size: 18px;
        }
        .content p {
            margin: 0;
            line-height: 1.5;
        }
        .content a {
            color: #333;
            text-decoration: none;
        }
        .content a:hover {
            text-decoration: underline;
        }
        .footer {
            color: #999;
            text-align: center;
            padding: 10px;
        }
        .footer img {
            max-width: 100%;
            height: auto;
        }
        .footer-content {
            display: flex;
            align-items: center;
        }
        .footer-text {
            flex-grow: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Base de conhecimento SGBR!</h1>
        </div>
        <div class="content">

            <p>Olá {{ $name }}, sejá bem vindo a nossa base de conhecimento SGBR. já está disponivel o seu artigo com a resolução de seu problema!</p>
            <br>
            <p>{{ $email_message }}</p>

            <h1>Artigo - {{ $id }}: {{ $subject }}!</h1>
            <p><a href="{{ url('/view-content/' . $id) }}">Clique aqui para visualizar o artigo</a></p>
        </div>
        <div class="footer">
          <div class="footer-content">
              <div class="footer-text">Atenciosamente,<br>SGBR Sistemas!</div>
          </div>
        </div>
    </div>
</body>
</html>
