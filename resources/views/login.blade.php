<x-nav></x-nav>
<x-layout>
<style>
    :root {
        /* Defining the variables from da175481-8cd5-44f4-88f5-ca11a098e5ab */
        --color-background: #0b0e14;
        --color-card: #161b22;
        --color-primary: #38bdf8;
        --color-border: #30363d;
        --color-foreground: #e6edf3;
        --spacing: 4px;
        --radius-md: 8px;
    }

    .form {
        color: var(--color-foreground);
        display: flex;
        min-hieght: 100vh;
        margin:auto;
        font-family:sans-serif;
        justify-content: center;
        align-items:center;
        padding-top: 60px;
    }

    /* Form Container styling from 608dae91-4945-4803-ab91-5fb6c13db6b6 */
    .fieldset {
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        padding: calc(var(--spacing) * 6);
        width: 100%;
        margin:auto;
        max-width: 400px;
    }

    .fieldset-legend {
        color: var(--color-primary);
        font-weight: bold;
        font-size: 1.2rem;
        padding: 0 10px;
    }

    /* Label styling from 4ffbda71-2a41-470c-9816-593fb938f0d9 */
    .label {
        display: block;
        margin-top: calc(var(--spacing) * 4);
        margin-bottom: calc(var(--spacing) * 2);
        font-size: 0.9rem;
        color: #8b949e;
    }

    /* Input styling from da175481-8cd5-44f4-88f5-ca11a098e5ab */
    .input {
        width: 100%;
        box-sizing: border-box; /* Crucial for width: 100% */
        background-color: var(--color-background);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-md);
        color: var(--color-foreground);
        padding: calc(var(--spacing) * 3);
        outline: 2px solid transparent;
        transition: all 0.2s ease;
    }

    /* Focus state from 1636ac42-41ed-4144-a889-f43b75930558 */
    .input:focus {
        border-color: var(--color-primary);
        box-shadow: 0 0 0 calc(var(--spacing) * 1) var(--color-background),
                    0 0 0 calc(var(--spacing) * 2) var(--color-primary);
    }

    /* Button styling from 608dae91-4945-4803-ab91-5fb6c13db6b6 & f118df98-b1ed-4f1b-b283-15345dc43283 */
    .btn-neutral {
        display: block;
        width: 100%;
        background-color: rgba(2, 105, 2, 0.932);
        color: var(--color-background);
        border: none;
        border-radius: var(--radius-md);
        padding: calc(var(--spacing) * 3);
        font-weight: 600;
        margin-top: calc(var(--spacing) * 6);
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .btn-neutral:hover {
        opacity: 0.9;
    }

    /* Error handling from 4ffbda71-2a41-470c-9816-593fb938f0d9 */
    .error-text {
        color: #f85149;
        font-size: 0.8rem;
        margin-top: 8px;
    }
</style>
<form action="/login" method="POST" class="form" autocomplete="off">
    @csrf
    <fieldset class="fieldset">
        <legend class="fieldset-legend">Sign In</legend>

        <label class="label">Email</label>
        <input type="email" name="email" class="input" placeholder="Enter Email...">

        <label class="label">Password</label>
        <input type="password" name="password" class="input" placeholder="Enter Password...">

        <label class="label">School Code</label>
        <input type="password" name="schoolcode" class="input" placeholder="Enter Schoolcode...">

        <button type="submit" class="btn-neutral">Sign In</button>

        @if ($errors->any())
            <div class="error-text">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </fieldset>
</form>

</x-layout>
