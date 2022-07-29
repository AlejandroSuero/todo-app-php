    {if !isset($task_title)}
    {$task_title = $task['task_title']}
    {/if}
    {if !isset($task_description)}
    {$task_description = $task['task_description']}
    {/if}
    {if !isset($task_id)}
    {$task_id = $task['task_id']}
    {/if}
<li class="modal list-group-item" style="background-color: transparent !important;" tabindex="-1" id="delete_modal_{$task_id}">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="text-bg-dark modal-content">
                                    <div class="modal-header text-bg-dark">
                                        <h2 class="modal-title">Delete Task</h2>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                            style="color: #fff !important;"></button>
                                    </div>
                                    <div class="modal-body text-bg-dark">
                                        <p>Are you sure on deleting this task?</p>
                                    </div>
                                    <div class="modal-footer text-bg-dark">
                                        <button type="button" class="py-2 px-3 button-red"
                                            data-bs-dismiss="modal">Close</button>
                                        <a class="py-2 px-3 button-border text-decoration-none"
                                            href="delete/{$task_id}">Delete Task</a>
                                    </div>
                                </div>
                            </div>
                        </li>