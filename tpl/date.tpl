<div id="searchresult_header" class="searchresult_header">
<h2 class="searchresult_header">Ergebnisse der 
    {if $archive.is_year}Jahres-{elseif $archive.is_month}Monats-{elseif $archive.is_day}Tages-{elseif $archive.is_time}Zeit-{/if}Archivsuche</h2>
<p>{if $archive.is_year}
    Du hast den Blog nach dem Jahr <strong>{$archive.searchterm}</strong> durchsucht.
    {elseif $archive.is_month}
    Du hast den Blog nach dem Monat <strong>{$archive.searchterm}</strong> durchsucht.
    {elseif $archive.is_day}
    Du hast den Blog nach dem <strong>{$archive.searchterm}</strong> durchsucht.
    {elseif $archive.is_time}
    Du hast den Blog nach der Uhrzeit <strong>{$archive.searchterm}</strong> durchsucht.
    Respekt dafür.
    {/if}
    Hier ist, was sich finden ließ.</p>
</div>
<div class="separate"></div>