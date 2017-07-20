<?php
$websetting = $this->session->userdata('websetting');
?>
</div>
<div style="text-align:center; font-size:11px; color:#999;">
        	<p><?=$websetting['site_copyright'];?></p>
            <p>This email is sent by <?=$websetting['site_name'];?>. <?=$websetting['site_address'];?> </p>
        </div>
    </div>
</div>
</body>
</html>