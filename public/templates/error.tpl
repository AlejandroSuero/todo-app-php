{include file="./header.tpl"}
<title>{$page_title}</title>
</head>

<body class="dark">

    <div class="container mx-auto">
        <div class="row px-4 py-5 my-5 text-center align-items-center" style="height: 90%;">

            <div class="col-sm text-center center">
                <h1 class="display-1 fw-bold">{$error_code}</h1>
                <h2 class="display-6">{$error_message}</h2>
                <a href="/practice/todo/" class="btn active">Volver</a>
            </div>
        </div>
{include file="./footer.tpl"}