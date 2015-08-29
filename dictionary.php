<?php 
$page_title = 'Learn Spanish | Dictionary';

include "includes/connect.php"; 
$q = mysql_query("SELECT * FROM words 
    LEFT JOIN types ON types.id = words.type_id
    ORDER BY datetime_added DESC
    LIMIT 20
");


include "includes/header.php"; 
?>       

<div class="innertube dictionary">
    <form action="" method="POST">
        <input type="text" id="search" name="search" placeholder="Search for a word or phrase...">
    </form>
    <table>
        
        <thead>
            <tr>
                <th>English</th>
                <th>Spanish</th>
                <th>Type</th>
                <th>Added</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $count = 0; // for row colours
                while($record = mysql_fetch_assoc($q)): 
            ?>
            <tr id="primary-results" <?php if($count % 2 == 0) { ?>class="odd"<?php } ?>>
                <td><?=$record['english']?></td>
                <td><?=$record['spanish']?></td>
                <td><?=$record['type']?></td>
                <td><?=date("d M Y", strtotime($record['datetime_added']))?></td>
                <td><?php if(isset($_SESSION['loggedin'])) { ?><button>Edit</button><button>Delete</button><?php } ?></td>
            </tr>
            <?php 
                $count++;
                endwhile;
            ?>
        </tbody>
        
    </table>
</div>
        
<?php include "includes/footer.php"; ?>

<script type="text/javascript">
    
    // Perform live search
    $("#search").keyup(function() {
        var search = $(this).val();
        $.ajax({
            url: "filter_word.php",
            dataType: "html",
            data: { search: search },
            success: function(result) {
                $("tbody").html(result);
            }
        });
    });
    
    // Edit modal
    $("table button").click(function() {
        
    });
    
</script>