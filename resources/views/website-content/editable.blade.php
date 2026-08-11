<span class="editable-content">

    {{ $editableContent->content }}

    @if(auth()->check() && auth()->user()->role === 'Admin')

        <button
            type="button"
            onclick="openContentEditor(
                {{ $editableContent->id }},
                @js($editableContent->content)
            )"
            style="
                margin-left: 8px;
                border: none;
                background: #f97316;
                color: white;
                border-radius: 50%;
                width: 28px;
                height: 28px;
                cursor: pointer;
                font-size: 14px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            "
            title="Edit content">

            ✏️

        </button>

    @endif

</span>


@if(auth()->check() && auth()->user()->role === 'Admin')

<!-- Edit Modal -->

<div
    id="contentEditorModal"
    style="
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.55);
        z-index: 99999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    "
>

    <div
        style="
            background: white;
            width: 100%;
            max-width: 500px;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25);
        "
    >

        <h2
            style="
                font-size: 24px;
                font-weight: 700;
                margin-bottom: 20px;
            "
        >
            Edit Website Content
        </h2>


        <form
            id="contentEditorForm"
            method="POST"
        >

            @csrf

            @method('PUT')


            <label
                style="
                    display: block;
                    font-weight: 600;
                    margin-bottom: 8px;
                "
            >
                Content
            </label>


            <textarea
                id="contentEditorInput"
                name="content"
                rows="5"
                required
                style="
                    width: 100%;
                    border: 1px solid #d1d5db;
                    border-radius: 10px;
                    padding: 12px;
                    resize: vertical;
                    outline: none;
                "
            ></textarea>


            <div
                style="
                    display: flex;
                    justify-content: flex-end;
                    gap: 10px;
                    margin-top: 20px;
                "
            >

                <button
                    type="button"
                    onclick="closeContentEditor()"
                    style="
                        background: #6b7280;
                        color: white;
                        border: none;
                        padding: 10px 20px;
                        border-radius: 8px;
                        cursor: pointer;
                    "
                >
                    Cancel
                </button>


                <button
                    type="submit"
                    style="
                        background: #f97316;
                        color: white;
                        border: none;
                        padding: 10px 20px;
                        border-radius: 8px;
                        cursor: pointer;
                    "
                >
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>


<script>

function openContentEditor(id, content)
{
    const modal = document.getElementById('contentEditorModal');

    const input = document.getElementById('contentEditorInput');

    const form = document.getElementById('contentEditorForm');


    input.value = content;


    form.action = '/website-content/' + id;


    modal.style.display = 'flex';

    input.focus();
}


function closeContentEditor()
{
    const modal = document.getElementById('contentEditorModal');

    modal.style.display = 'none';
}


/* Close when clicking outside the popup */

document.addEventListener('click', function(event)
{
    const modal = document.getElementById('contentEditorModal');

    if (
        event.target === modal
    ) {
        closeContentEditor();
    }
});

</script>

@endif