<?php 
$page_title = 'Learn Spanish | Home';
include "includes/header.php";
?>      

<div class="innertube">
    <div class="container hidden">
         <div class="bar">
            <ul class="hidden">
                <li></li>
            </ul>
        </div>
        <div class="top">
           <span id="english-span" class="hidden"></span>
        </div>
        <div class="bottom">
            <span id="spanish-span" class="hidden"></span>
        </div>
    </div>
    
    <div class="controls">
        <ul>
            <li><button id="showTrans" class="hidden">Show Word</button></li>
            <li><button id="clickToBegin">Begin flashcards</button></li>
        </ul>
        <ul>
            <li><button id="showFilters" class="hidden">Show filters</button></li>
            <li><button id="toggleRevision" class="hidden">To revise</button></li>
        </ul>
        <div id="filters" class="filters hidden">
            <table class="types">
                <?php include_once "includes/connect.php";
                    $types = mysql_query("SELECT * FROM types");
                    $count = 0;
                ?>
                <?php while($type = mysql_fetch_assoc($types)): ?>
                    <?php if($count==0)echo "<tr>"; ?>
                        <td><input type="checkbox" name="types[<?=$type['type']?>]" id="<?=$type['id']?>"><?=$type['type']?></td>
                    <?php 
                        $count++; 
                        if($count == 3) {
                            echo "</tr>";
                            $count=0;
                        }
                    ?>
                <?php endwhile; ?>
            </table>
            <div id="revision"><input type="checkbox">Revision list</div>
            <select id="datefilter">
                <option value="all" selected>All</option>
                <option value="week">Submitted in the last week</option>
                <option value="month">Submitted in the last month</option>
            </select>
        </div>
    </div>
    
</div>
        
<?php include "includes/footer.php"; ?>

