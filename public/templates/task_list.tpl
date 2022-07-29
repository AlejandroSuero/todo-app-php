{if !isset($task_title)}
    {$task_title = $task['task_title']}
{/if}
{if !isset($task_description)}
    {$task_description = $task['task_description']}
{/if}
{if !isset($task_id)}
    {$task_id = $task['task_id']}
{/if}
{if !isset($task_done)}
    {$task_done = $task['task_done']}
{/if}

<li class="text-bg-dark list-group-item d-flex align-items-center" id="{$task_id}">
    <blockquote
        class="pt-3 flex-grow-1 blockquote {if $task_done eq '1'} text-decoration-line-through text-muted {/if}">
        <p class="mb-3">{$task_title}</p>
        {if !empty({$task_description})}
            <footer class="blockquote-footer">{$task_description}</footer>
        {/if}
        {if $task_done eq '1'}
            <div class="badge active text-wrap" style="width: 6rem;">
                Completed
            </div>
        {else}
            <a href="edit/{$task_id}" class="text-decoration-none fs-5">Edit tasks
                <i class="bi bi-pencil-square icon"></i></a>
        {/if}
    </blockquote>
    <div class="d-flex gap-1 px-2">
        <div class="d-flex align-items-center">
            <a role="button" class="py-2 px-3 button-red-border" title="Delete task" aria-label="Delete task"
                data-bs-toggle="modal" data-bs-target="#delete_modal_{$task_id}">
                <i class="bi bi-trash-fill fs-5 icon"></i>
            </a>
        </div>
        <div class="px-1">
            <div class="d-flex align-items-center">

                {if $task_done eq '0'}
                    <a class="py-2 px-3 button-border" title="Mark as done" aria-label="Mark as done"
                        href="done/{$task_id}">
                        <i class="bi bi-check-square fs-5 icon"></i>
                    {else}
                        <a class="py-2 px-3 button-border" title="Mark as undone" aria-label="Mark as undone"
                            href="done/{$task_id}">
                            <i class="bi bi-check-square-fill fs-5 icon"></i>
                        {/if}
                    </a>
            </div>
        </div>

    </div>
</li>