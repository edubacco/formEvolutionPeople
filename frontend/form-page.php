<!DOCTYPE html>
<html>
<head>
    <title>Form per EvolutionPeople</title>

    <link rel="stylesheet" href="frontend/assets/formEvolutionPeople.min.css" />
</head>
<body class="container">
<div class="row title">
    <h1>Compila il form</h1>
</div>
<div class="row msgs">
    <?php if (isset($return['msg'])&& !empty($return['msg'])): ?>
        <p class="bg-success text-success"><?=$return['msg']; ?></p>
    <?php endif; ?>
    <?php if (isset($return['errors'])&& !empty($return['errors'])): ?>
        <?php foreach ($return['errors'] as $key => $error): ?>
            <p class="bg-warning text-warning "><?=$error; ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<div class="row">
    <?php if (isset($columns) && !empty($columns)): ?>
        <form method="post" action="">
            <?php $generic_id = 0; ?>
            <?php foreach ($columns as $slug => $column): $generic_id++;
                $req = isset($column['attr']) && !(false === strpos('required', $column['attr'])); ?>

                <div class="input-group <?= isset($return['errors'][$slug])? 'has-error' :  '' ?>">
                    <?php switch ($column['type']):
                        case 'string': ?>
                            <span class="input-group-addon" id="campo-<?=$generic_id?>"><?=$column['label']?> <?=$req?'<span class="req">*</span>':''?></span>
                            <input
                                type="string"
                                name="<?=$slug?>"
                                class="form-control"
                                placeholder="<?=$column['label']?>"
                                aria-describedby="campo-<?=$generic_id?>"
                                value="<?=isset($return['data'][$slug])? $return['data'][$slug] : '' ?>"
                                <?= $req?'required':'' ?>
                            />
                            <?php break;

                        case 'psw_string': ?>
                            <span class="input-group-addon" id="campo-<?=$generic_id?>"><?=$column['label']?> <?=$req?'<span class="req">*</span>':''?></span>
                            <input
                                type="password"
                                name="<?=$slug?>"
                                class="form-control"
                                placeholder="<?=$column['label']?>"
                                aria-describedby="campo-<?=$generic_id?>"
                                value="<?=isset($return['data'][$slug])? $return['data'][$slug] : '' ?>"
                                <?=$req?'required':''?>
                            />
                            <input
                                type="password"
                                name="<?=$slug?>_repeat"
                                class="form-control"
                                placeholder="Ripeti <?=$column['label']?>"
                                aria-describedby="campo-<?=$generic_id?>"
                                value="<?=isset($return['data'][$slug])? $return['data'][$slug] : '' ?>"
                                <?=$req?'required':''?>
                            />
                            <?php break;

                        case 'radio': ?>
                            <span class="input-group-addon" id="campo-<?=$generic_id?>"><?=$column['label']?> <?=$req?'<span class="req">*</span>':''?></span>
                            <div class="form-control">
                            <?php foreach ($column['values'] as $key => $value): ?>
                                <input
                                    type="radio"
                                    name="<?=$slug?>"
                                    value="<?=$key?>"
                                    aria-describedby="campo-<?=$generic_id?>"
                                    <?=$return['data'][$slug] === $key? 'checked' : '';?>
                                /> <?=$value?>

                            <?php endforeach; ?>
                            </div>
                            <?php break;

                    endswitch; ?>
                </div>
            <?php endforeach; ?>
            <input type="hidden" name="sending_form" value="1"/>
            <input type="submit" class="btn btn-success btn-lg" value="Registrati" />
        </form>
    <?php endif; ?>
</div><!-- .row -->
</body>
</html>