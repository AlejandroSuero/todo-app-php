{include file="header.tpl"}
<meta property="og:description" value="Edit task with id: {$task_id}" />

</head>

<body class="dark d-flex align-items-center flex-column" style="height: 90vh;">
    <header class="mb-5">
        <nav class="navbar navbar-expand-lg navbar-dark justify-content-center align-items-center">
            <a title="Back to Tasks" class="navbar-brand" href="tasks">
                <img alt="ToDo App Logo" height="144" width="144" src="./images/icons/ToDo_App_icon_144x144.png" />
            </a>
            <h1 class="display-1 fw-bold m-0" title="{$page_title}">{$page_title}</h1>
        </nav>
    </header>
    <div class="container py-5">
        <div class="row gap-5">
            <div class="col-sm">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb gap-1">
                        <li class="breadcrumb-item fs-4 d-flex align-items-center"><a class="text-decoration-none"
                                href="tasks"><i class="prymary bi bi-arrow-left-square fs-5 me-2"></i>Tasks</a></li>
                        <li class="breadcrumb-item fs-4" aria-current="page">Edit Tasks</li>
                    </ol>
                </nav>

                <form class="list-group gap-2" action="update/{$task_id}" method="post">
                    {include file="delete_modal.tpl"}
                    <div class="list-group gap-1">
                        <label class="h2" for="task_title">Task Title</label>
                        <input type="text" class="p-2 text-bg-dark form-control-purple form-control-dark"
                            id="task_title" name="task_title" placeholder="New Task Title..." value="{$task_title}" />
                    </div>
                    <div class="list-group gap-2">
                        <label for="task_description" class="h2">Task Description</label>
                        <textarea class="p-2 text-bg-dark form-control-purple form-control-dark" name="task_description"
                            id="task_description" placeholder="New Task Description..." rows="5"
                            style="resize: none;">{$task_description}</textarea>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <a role="button"
                            class="fs-4 py-2 px-4 flex-grow-1 button-red-border text-center text-decoration-none icon d-flex align-items-center justify-content-center gap-3"
                            title="Delete task" aria-label="Delete task" data-bs-toggle="modal"
                            data-bs-target="#delete_modal_{$task_id}">Delete Task
                            <i class="bi bi-trash-fill fs-5 icon" style="color: #fff !important;"></i>
                        </a>
                        <button type="submit" class="fs-4 py-2 px-4 flex-grow-1 button text-decoration-none"
                            name="edit_task" id="edit_task">Edit Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
{include file="footer.tpl"}