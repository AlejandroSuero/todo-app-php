{include file="./header.tpl"}

<meta property="og:description" value="Manage your own tasks." />

</head>

<body class="dark">
    <div class="container py-5">
        <header class="mb-5">
            <nav class="navbar navbar-expand-lg navbar-dark justify-content-center align-items-center">
                <a title="Back to Tasks" class="navbar-brand" href="tasks">
                    <img alt="ToDo App Logo" height="144" width="144" src="./images/icons/ToDo_App_icon_144x144.png" />
                </a>
                <h1 class="display-1 fw-bold m-0" title="{$page_title}">{$page_title}</h1>
            </nav>
        </header>
        <main class="row gap-5">
            <div class="col-sm">
                <h2 class="display-4 fw-bold">Tasks</h2>
                <ul class="list-group gap-2">
                    {if count($tasks) == 0}
                        <li style="background-color: #b0466180 !important;" class="text-bg-dark list-group-item d-flex align-items-center" id="no_tasks">
                            <blockquote class="pt-3 flex-grow-1 blockquote fs-2">
                                <p class="mb-3">There are no tasks</p>
                                <footer class="blockquote-footer">Start creating one</footer>
                            </blockquote>
                        </li>
                    {else}
                        {foreach from=$tasks item=task}
                            {include file="./delete_modal.tpl"}
                            {include file="./task_list.tpl"}
                        {/foreach}
                    {/if}
                </ul>
            </div>
            <div class="col-sm">
                <h2 class="display-4 fw-bold">Create Task</h2>
                <form class="list-group gap-2" action="add" method="post">
                    <div class="list-group gap-1">
                        <label class="h2" for="task_title">Task Title</label>
                        {if isset($error)}
                            <p class="error-text">Can not leave the title empty before adding a new task.</p>
                            <input type="text" class="p-2 error is-invalid text-bg-dark form-control-dark" id="task_title"
                                name="task_title" placeholder="New Task Title..." />
                        {else}
                            <input type="text" class="p-2 text-bg-dark form-control-purple form-control-dark"
                                id="task_title" name="task_title" placeholder="New Task Title..." />
                        {/if}
                    </div>
                    <div class="list-group gap-2">
                        <label for="task_description" class="h2">Task Description</label>
                        <textarea class="p-2 text-bg-dark form-control-purple form-control-dark" name="task_description"
                            id="task_description" placeholder="New Task Description..." rows="5"
                            style="resize: none;"></textarea>
                    </div>
                    <button type="submit" class="fs-4 py-2 button" name="add_task" id="add_task">Add New Task</button>
                </form>
            </div>
        </main>

{include file="./footer.tpl"}