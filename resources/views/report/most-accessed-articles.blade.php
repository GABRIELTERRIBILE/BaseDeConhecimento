<style>
    @page {
        size: A4;
        margin: 0;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Tahoma, Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 24px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border: 1px solid #000; /* Add a black border */
    }

    .header {
        margin-top: 24px;
        text-align: center;
    }

    .header img {
        width: 80px;
        margin-right: 16px;
    }

    .title {
        text-align: center;
    }

    .title h1 {
        font-size: 24px;
        color: #333;
        margin: 0;
    }

    .title p {
        font-size: 14px;
        color: #777;
        margin: 0;
    }


    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 24px;
        background-color: #fff;
    }

    th,
    td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        border-bottom-width: 2px; /* Adicionado para aumentar a espessura da borda inferior */
    }

    th:nth-child(2)::before,
    td:nth-child(2)::before {
        content: "";
        display: block;
        height: 100%;
        border-left: 2px solid #ddd;
    }

    th:nth-child(5)::after,
    td:nth-child(5)::after {
        content: "";
        display: block;
        height: 100%;
        border-right: 2px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        color: #333;
    }

    tr:hover {
        background-color: #f9f9f9;
    }
    .footer {
    margin-top: 24px;
    text-align: center;
    }

    .footer p {
        font-size: 14px;
        color: #777;
        margin: 0;
    }
</style>

<div class="container">
    <div class="header">
        <img src="{{ asset('images/logo-sgbr2.png') }}" alt="Logo" style="float: right;">
        <div class="title">
            <h1>Rank de artigos mais acessados no mês</h1>
            <p>Período: {{ date('d/m/Y', strtotime($startDate)) }} - {{ date('d/m/Y', strtotime($endDate)) }}</p>
            <br>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Assunto</th>
                <th>Visualizações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mostAccessedArticles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->name }}</td>
                    <td>{{ $article->subject }}</td>
                    <td>{{ $article->views }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <p>&copy; SGBR - Todos os direitos reservados</p>
    </div>
</div>
