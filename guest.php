<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #d5d5d5
    }

    th {
        background-color: #424242;
        color: #ffffff;
    }

    Body {
        font-family: Calibri, Helvetica, sans-serif;
        background-color: #848484;
    }

    button {
        background-color: #000000;
        width: 20%;
        color: white;
        padding: 15px;
        margin: 10px 0px;
        border: none;
        cursor: pointer;
        transition-duration: 0.4s;
        opacity: 0.7;
    }

    button:hover {
        background-color: #575757;
        color: #ffffff;
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
    }

    form {
        border: 3px solid #000000;
    }

    input[type=text], input[type=password], textarea, select {
        width: 20%;
        margin: 8px 0;
        padding: 12px 20px;
        display: inline-block;
        border: 3px solid #000000;
        box-sizing: border-box;
        box-shadow: 0 12px 16px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
    }

</style>
<form method="post" action="index.php">
    <label><h1><b>Creating repair report</b></h1></label>
    <p>
    <h2><label><b>Your name:</b></label></h2>
    </p>
    <input type="text" name="name" required>
    </p>
    <p>
    <h2><label><b>Your surname:</b></label></h2>
    </p>
    <input type="text" name="surname" required>
    <p>
    <h2><label><b>Car model:</b></label></h2>
    </p>
    <select name="model_id">
        <option value="1">Kuga</option>
        <option value="2">Focus</option>
        <option value="3">Fiesta</option>
        <option value="4">EcoSport</option>
        <option value="5">Mustang</option>
        <option value="6">Edge</option>
        <option value="7">Mondeo</option>
        <option value="8">Ranger</option>
    </select>
    <p>
    <h2><label><b>Your phone:</b></label></h2>
    </p>
    <input type="text" name="phone" required>
    </p>
    <h2><label><b>Date(yyyy-mm-dd):</b></label></h2>
        </p>
        <p>
            <input type="text" name="date" required>
        </p>
        <h2><label><b>Time:</b></label></h2>
            </p>
            <select name="hours">
                <option value="8">08</option>
                <option value="9">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
            </select>
            <select name="minutes">
                <option value="00">:00</option>
                <option value="30">:30</option>
            </select>
            </p>
            <p>
            <h2><label><b>Additional info:</b></label>
            </p>
            <textarea name="sell_info" rows="5" cols="50"></textarea>
            <p>
                <button type="submit" name="create_rep_ord" value="Create"><b>Create</b></button>
            </p>
</form>