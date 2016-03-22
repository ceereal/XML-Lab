<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="options">
    <div class ="options">
        <form action="Welcome/showTimetable">
            <select name="day">
                <option value="{day}"> {option} </option>
                {/option}
            </select>
            <input type='submit' value='Search'>
        </form>
        <a href="Welcome/showTimetable/{option}">{option} option</a>
    </div>
    {/options}
</div>