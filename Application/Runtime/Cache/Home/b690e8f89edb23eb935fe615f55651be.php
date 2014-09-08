<?php if (!defined('THINK_PATH')) exit();?>	
<div>

	<div>
		<p><?php echo ($comment["0"]["nickname"]); ?>|<?php echo ($comment["0"]["content"]); ?>|<?php echo ($comment["0"]["publish_time"]); ?></p>
		<p><?php echo ($comment["1"]["nickname"]); ?>|<?php echo ($comment["1"]["content"]); ?>|<?php echo ($comment["1"]["publish_time"]); ?></p>
		<p><?php echo ($comment["2"]["nickname"]); ?>|<?php echo ($comment["2"]["content"]); ?>|<?php echo ($comment["2"]["publish_time"]); ?></p>
		<p><?php echo ($comment["3"]["nickname"]); ?>|<?php echo ($comment["3"]["content"]); ?>|<?php echo ($comment["3"]["publish_time"]); ?></p>
		<p><?php echo ($comment["4"]["nickname"]); ?>|<?php echo ($comment["4"]["content"]); ?>|<?php echo ($comment["4"]["publish_time"]); ?></p>
		<p><?php echo ($comment["5"]["nickname"]); ?>|<?php echo ($comment["5"]["content"]); ?>|<?php echo ($comment["5"]["publish_time"]); ?></p>
		<p><?php echo ($comment["6"]["nickname"]); ?>|<?php echo ($comment["6"]["content"]); ?>|<?php echo ($comment["6"]["publish_time"]); ?></p>
		<p><?php echo ($comment["7"]["nickname"]); ?>|<?php echo ($comment["7"]["content"]); ?>|<?php echo ($comment["7"]["publish_time"]); ?></p>
		<p><?php echo ($comment["8"]["nickname"]); ?>|<?php echo ($comment["8"]["content"]); ?>|<?php echo ($comment["8"]["publish_time"]); ?></p>
		<p><?php echo ($comment["9"]["nickname"]); ?>|<?php echo ($comment["9"]["content"]); ?>|<?php echo ($comment["9"]["publish_time"]); ?></p>
	</div>
	<script type="text/javascript">
    localStorage.nickname=<?php echo ($visitor["nicknickname"]); ?>;
    localStorage.id=<?php echo ($visitor["id"]); ?>;
    
    </script>

</div>