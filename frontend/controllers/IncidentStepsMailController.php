<?php 
namespace frontend\controllers;
use frontend\models\IncidentRefService;
use frontend\models\IncidentSteps;
use frontend\models\TTicket;

class IncidentStepsMailController extends SiteController
{
    function mailCreate($model,$title) {
        $services_model = IncidentRefService::find()->where(['incident_id' => $model->incident_id])->with('refService')->all();
        $services = '';
        $start_time = IncidentSteps::needlessTime($model->incident_id,1)['clock'];
        $startDataTime = new \DateTime($start_time);
        $start_time_format = $startDataTime->format('d.m.y в H:i');
        $end_time = IncidentSteps::needlessTime($model->incident_id,3)['clock'];
        if (isset($end_time)) {
            $endDataTime = new \DateTime($end_time);
            $end_time_format = $endDataTime->format('d.m.y в H:i');
        }
        else {
            $end_time_format = null;
        }
        $tticket = TTicket::find()->where(['incident_id' => $model->incident_id])->andWhere(['ref_type_tt_id' => 1])->one();
        if (isset($tticket->t_number)){
            $serviceNow = $tticket->t_number;
        }
        else {
            $serviceNow = null;
        }
        foreach ($services_model as $service){
            $services .= $service->refService->name.'<br>';
        }
        $path = \yii\helpers\Url::toRoute(['/img'], 'http').'/'.sha1('o4kotvoeimamashi' );
        $incident = \frontend\models\Incident::find()->where(['id' => $model->incident_id])->one();
        if ($incident->status == 3) {
            $duration =
                    '<tr style="mso-yfti-irow:2;height:21.95pt">
                        <td width="316" valign="top" style="width:237.05pt;border:solid #BFBFBF 1.0pt;
                            border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:21.95pt">
                            <p class="MsoNormal" style="mso-element:frame;
                                mso-element-frame-hspace:9.0pt;
                                mso-element-wrap:around;
                                mso-element-anchor-vertical:paragraph;
                                mso-element-anchor-horizontal:column;
                                mso-height-rule:exactly">
                                <span style="font-family:&quot;Tahoma&quot;,sans-serif">Продолжительность(ЧЧ:ММ):<o:p></o:p></span>
                            </p>
                        </td>
                        <td width="255" valign="top" style="width:191.6pt;border-top:none;
                            border-left:none;border-bottom:solid #BFBFBF 1.0pt;
                            border-right:solid #BFBFBF 1.0pt;
                            padding:0cm 5.4pt 0cm 5.4pt;height:21.95pt">
                            <p class="MsoNormal" style="mso-element:frame;
                                mso-element-frame-hspace:9.0pt;
                                mso-element-wrap:around;
                                mso-element-anchor-vertical:paragraph;
                                mso-element-anchor-horizontal:column;mso-height-rule:exactly">
                                <i>
                                    <span style="font-family:&quot;Tahoma&quot;,sans-serif">
                                    '.substr($incident->duration, 0,-3).'<o:p></o:p>
                                    </span>
                                </i>
                            </p>
                        </td>
                    </tr>';
        }
        else {
            $duration = null;
        }
        $text = 
            '
            <style>
            @font-face
                {font-family:"Cambria Math";
                panose-1:2 4 5 3 5 4 6 3 2 4;
                mso-font-charset:1;
                mso-generic-font-family:roman;
                mso-font-pitch:variable;
                mso-font-signature:-536870145 1107305727 0 0 415 0;}
            @font-face
                {font-family:Calibri;
                panose-1:2 15 5 2 2 2 4 3 2 4;
                mso-font-charset:204;
                mso-generic-font-family:swiss;
                mso-font-pitch:variable;
                mso-font-signature:-536870145 1073786111 1 0 415 0;}
            @font-face
                {font-family:Tahoma;
                panose-1:2 11 6 4 3 5 4 4 2 4;
                mso-font-charset:204;
                mso-generic-font-family:swiss;
                mso-font-pitch:variable;
                mso-font-signature:-520081665 -1073717157 41 0 66047 0;}
            p.MsoNormal, li.MsoNormal, div.MsoNormal
                {mso-style-unhide:no;
                mso-style-qformat:yes;
                mso-style-parent:"";
                margin:0cm;
                margin-bottom:.0001pt;
                mso-pagination:widow-orphan;
                font-size:11.0pt;
                font-family:"Times New Roman",serif;
                mso-fareast-font-family:Calibri;
                mso-fareast-theme-font:minor-latin;}
            a:link, span.MsoHyperlink
                {mso-style-noshow:yes;
                mso-style-priority:99;
                color:#0563c1;
                text-decoration:underline;
                text-underline:single;}
            a:visited, span.MsoHyperlinkFollowed
                {mso-style-noshow:yes;
                mso-style-priority:99;
                color:#954f72;
                text-decoration:underline;
                text-underline:single;}
            p.msonormal0, li.msonormal0, div.msonormal0
                {mso-style-name:msonormal;
                mso-style-unhide:no;
                mso-margin-top-alt:auto;
                margin-right:0cm;
                mso-margin-bottom-alt:auto;
                margin-left:0cm;
                mso-pagination:widow-orphan;
                font-size:12.0pt;
                font-family:"Times New Roman",serif;
                mso-fareast-font-family:Calibri;
                mso-fareast-theme-font:minor-latin;}
            .MsoChpDefault
                {mso-style-type:export-only;
                mso-default-props:yes;
                font-family:"Calibri",sans-serif;
                mso-ascii-font-family:Calibri;
                mso-ascii-theme-font:minor-latin;
                mso-fareast-font-family:Calibri;
                mso-fareast-theme-font:minor-latin;
                mso-hansi-font-family:Calibri;
                mso-hansi-theme-font:minor-latin;
                mso-bidi-font-family:"Times New Roman";
                mso-bidi-theme-font:minor-bidi;
                mso-fareast-language:EN-US;}
            @page WordSection1
                {size:612.0pt 792.0pt;
                margin:2.0cm 42.5pt 2.0cm 3.0cm;
                mso-header-margin:36.0pt;
                mso-footer-margin:36.0pt;
                mso-paper-source:0;}
            div.WordSection1
                {page:WordSection1;}
            </style>    
            <table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" align="left" width="0" 
                style="width:463.2pt;
                mso-cellspacing:0cm;mso-yfti-tbllook:1184;
                mso-table-lspace:9.0pt;
                margin-left:6.75pt;
                mso-table-rspace:9.0pt;
                margin-right:6.75pt;
                mso-table-anchor-vertical:paragraph;
                mso-table-anchor-horizontal:column;
                mso-table-left:left;
                mso-padding-alt:0cm 0cm 0cm 0cm">
                <tbody>
                    <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;mso-yfti-lastrow:yes">
                        <td width="618" style="width:463.2pt;padding:0cm 0cm 0cm 0cm">
                            <p class="MsoNormal" 
                                style="line-height:105%;
                                mso-element:frame;
                                mso-element-frame-hspace:9.0pt;
                                mso-element-wrap:around;
                                mso-element-anchor-vertical:paragraph;
                                mso-element-anchor-horizontal:column;
                                mso-height-rule:exactly">
                                <span style="font-size:12.0pt;
                                    line-height:105%;
                                    font-family:&quot;Times New Roman&quot;,serif;
                                mso-fareast-language:RU">
                                <img width="604" height="151" src="'.$path.'/image002.gif" 
                                    style="height:1.572in;
                                    width:6.291in">
                                        <o:p></o:p>
                                </span>
                            </p>
                            <table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="0" 
                                style="width:451.2pt;
                                mso-cellspacing:0cm;
                                mso-yfti-tbllook:1184;
                                mso-padding-alt:0cm 0cm 0cm 0cm">
                                <tbody>
                                    <tr style="mso-yfti-irow:0;mso-yfti-firstrow:yes;height:1.0cm">
                                        <td width="618" colspan="2" 
                                            style="width:450.0pt;
                                            padding:18.75pt 18.75pt 18.75pt 18.75pt;
                                            height:1.0cm">
                                            <p class="MsoNormal" align="center" 
                                                style="text-align:center;
                                                line-height:22.5pt;
                                                mso-element:frame;
                                                mso-element-frame-hspace:9.0pt;
                                                mso-element-wrap:around;
                                                mso-element-anchor-vertical:paragraph;
                                                mso-element-anchor-horizontal:column;
                                                mso-height-rule:exactly">
                                                <b>
                                                    <span style="font-size:16.0pt;
                                                    font-family:&quot;Tahoma&quot;,sans-serif;
                                                    color:#2E75B6;text-transform:uppercase;
                                                    mso-fareast-language:RU">'.$title.'</span>
                                                </b>
                                                <b>
                                                    <span lang="EN-US" style="font-size:16.0pt;
                                                        font-family:&quot;Tahoma&quot;,sans-serif;
                                                        color:#0077C8;
                                                        text-transform:uppercase;
                                                        mso-ansi-language:EN-US;
                                                        mso-fareast-language:RU">
                                                        <o:p></o:p>
                                                    </span>
                                                </b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr style="mso-yfti-irow:1;mso-yfti-lastrow:yes">
                                        <td width="5" nowrap="" 
                                            style="width:3.6pt;
                                            background:#0077C8;
                                            padding:0cm 0cm 0cm 0cm">
                                            <p class="MsoNormal" 
                                                style="line-height:105%;
                                                mso-element:frame;
                                                mso-element-frame-hspace:9.0pt;mso-element-wrap:around;
                                                mso-element-anchor-vertical:paragraph;
                                                mso-element-anchor-horizontal:column;
                                                mso-height-rule:exactly">
                                                <span style="mso-fareast-language:RU">
                                                    <img width="5" height="1" 
                                                    src="'.$path.'/image003.gif"
                                                    style="height:.01in;width:.052in">
                                                </span>
                                                <span style="font-size:12.0pt;
                                                    line-height:105%;
                                                    font-family:&quot;Times New Roman&quot;,serif;
                                                    mso-fareast-language:RU">
                                                    <o:p></o:p>
                                                </span>
                                            </p>
                                        </td>
                                        <td width="613" style="width:447.6pt;
                                            background:white;
                                            padding:0cm 0cm 0cm 0cm">
                                            <table class="MsoNormalTable" 
                                                border="0" 
                                                cellspacing="0" 
                                                cellpadding="0" 
                                                width="100%" 
                                                style="width:100.0%;
                                                mso-cellspacing:0cm;
                                                mso-yfti-tbllook:1184;
                                                mso-padding-alt:0cm 0cm 0cm 0cm">
                                                <tbody>
                                                    <tr style="mso-yfti-irow:0;
                                                        mso-yfti-firstrow:yes;
                                                        mso-yfti-lastrow:yes;
                                                        height:275.6pt">
                                                        <td style="background:white;
                                                            padding:15.0pt 15.0pt 15.0pt 15.0pt;
                                                            height:275.6pt">
                                                            <table class="MsoNormalTable" 
                                                                border="0" 
                                                                cellspacing="0" 
                                                                cellpadding="0" 
                                                                width="0" 
                                                                style="width:428.65pt;border-collapse:collapse;
                                                                mso-yfti-tbllook:1184;
                                                                mso-padding-alt:0cm 0cm 0cm 0cm">
                                                                <tbody>
                                                                    <tr style="mso-yfti-irow:0;
                                                                        mso-yfti-firstrow:yes;
                                                                        height:21.85pt">
                                                                        <td width="316" valign="top" 
                                                                            style="width:237.05pt;
                                                                            border:solid #BFBFBF 1.0pt;
                                                                            padding:0cm 5.4pt 0cm 5.4pt;
                                                                            height:21.85pt">
                                                                            <p class="MsoNormal" style="mso-element:frame;
                                                                                mso-element-frame-hspace:9.0pt;
                                                                                mso-element-wrap:around;
                                                                                mso-element-anchor-vertical:paragraph;
                                                                                mso-element-anchor-horizontal:column;
                                                                                mso-height-rule:exactly">
                                                                                <span style="font-family:&quot;Tahoma&quot;,sans-serif">Затронутые сервисы:<o:p></o:p>
                                                                                </span>
                                                                            </p>
                                                                        </td>
                                                                        <td width="255" valign="top" style="width:191.6pt;
                                                                            border:solid #BFBFBF 1.0pt;
                                                                            border-left:none;
                                                                            padding:0cm 5.4pt 0cm 5.4pt;
                                                                            height:21.85pt">
                                                                            <p class="MsoNormal">
                                                                                <i>
                                                                                    <span style="font-family:&quot;Tahoma&quot;,sans-serif">
                                                                                        '.$services.'
                                                                                    </span>
                                                                                </i>
                                                                                <span style="font-family:&quot;Tahoma&quot;,sans-serif">
                                                                                    <o:p></o:p>
                                                                                </span>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="mso-yfti-irow:1;height:22.15pt">
                                                                        <td width="316" valign="top" style="width:237.05pt;
                                                                            border:solid #BFBFBF 1.0pt;
                                                                            border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:22.15pt">
                                                                            <p class="MsoNormal" style="mso-element:frame;
                                                                                mso-element-frame-hspace:9.0pt;
                                                                                mso-element-wrap:around;
                                                                                mso-element-anchor-vertical:paragraph;
                                                                                mso-element-anchor-horizontal:column;
                                                                                mso-height-rule:exactly">
                                                                                <span style="font-family:&quot;Tahoma&quot;,sans-serif">Время начала инцидента:<o:p></o:p>
                                                                                </span>
                                                                            </p>
                                                                        </td>
                                                                        <td width="255" valign="top" style="width:191.6pt;border-top:none;
                                                                            border-left:none;
                                                                            border-bottom:solid #BFBFBF 1.0pt;
                                                                            border-right:solid #BFBFBF 1.0pt;
                                                                            padding:0cm 5.4pt 0cm 5.4pt;height:22.15pt">
                                                                            <p class="MsoNormal" style="mso-element:frame;
                                                                                mso-element-frame-hspace:9.0pt;
                                                                                mso-element-wrap:around;
                                                                                mso-element-anchor-vertical:paragraph;
                                                                                mso-element-anchor-horizontal:column;mso-height-rule:exactly">
                                                                                <i>
                                                                                    <span style="font-family:&quot;Tahoma&quot;,sans-serif">
                                                                                    '.$start_time_format.'<o:p></o:p>
                                                                                    </span>
                                                                                </i>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="mso-yfti-irow:2;height:21.95pt">
                                                                        <td width="316" valign="top" style="width:237.05pt;border:solid #BFBFBF 1.0pt;
                                                                            border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:21.95pt">
                                                                            <p class="MsoNormal" style="mso-element:frame;
                                                                                mso-element-frame-hspace:9.0pt;
                                                                                mso-element-wrap:around;
                                                                                mso-element-anchor-vertical:paragraph;
                                                                                mso-element-anchor-horizontal:column;
                                                                                mso-height-rule:exactly">
                                                                                <span style="font-family:&quot;Tahoma&quot;,sans-serif">Время окончания инцидента:<o:p></o:p></span>
                                                                            </p>
                                                                        </td>
                                                                        <td width="255" valign="top" style="width:191.6pt;border-top:none;
                                                                            border-left:none;border-bottom:solid #BFBFBF 1.0pt;
                                                                            border-right:solid #BFBFBF 1.0pt;
                                                                            padding:0cm 5.4pt 0cm 5.4pt;height:21.95pt">
                                                                            <p class="MsoNormal" style="mso-element:frame;
                                                                                mso-element-frame-hspace:9.0pt;
                                                                                mso-element-wrap:around;
                                                                                mso-element-anchor-vertical:paragraph;
                                                                                mso-element-anchor-horizontal:column;mso-height-rule:exactly">
                                                                                <i>
                                                                                    <span style="font-family:&quot;Tahoma&quot;,sans-serif">
                                                                                    '.$end_time_format.'<o:p></o:p>
                                                                                    </span>
                                                                                </i>
                                                                            </p>
                                                                        </td>
                                                                    </tr>'.
                                                                    $duration.
                                                                    '<tr style="mso-yfti-irow:3;height:22.5pt">
                                                                        <td width="316" valign="top" style="width:237.05pt;
                                                                            border:solid #BFBFBF 1.0pt;
                                                                            border-top:none;
                                                                            padding:0cm 5.4pt 0cm 5.4pt;
                                                                            height:22.5pt">
                                                                            <p class="MsoNormal" style="mso-element:frame;
                                                                                mso-element-frame-hspace:9.0pt;
                                                                                mso-element-wrap:around;
                                                                                mso-element-anchor-vertical:paragraph;
                                                                                mso-element-anchor-horizontal:column;
                                                                                mso-height-rule:exactly">
                                                                                <span style="font-family:&quot;Tahoma&quot;,sans-serif">Номер инцидента в ServiceNow:<o:p></o:p>
                                                                                </span>
                                                                            </p>
                                                                        </td>
                                                                        <td width="255" valign="top" style="width:191.6pt;border-top:none;
                                                                            border-left:none;border-bottom:solid #BFBFBF 1.0pt;
                                                                            border-right:solid #BFBFBF 1.0pt;
                                                                            padding:0cm 5.4pt 0cm 5.4pt;height:22.5pt">
                                                                            <p class="MsoNormal" style="mso-element:frame;
                                                                                mso-element-frame-hspace:9.0pt;
                                                                                mso-element-wrap:around;
                                                                                mso-element-anchor-vertical:paragraph;
                                                                                mso-element-anchor-horizontal:column;mso-height-rule:exactly">
                                                                                <i>
                                                                                    <span style="font-family:&quot;Tahoma&quot;,sans-serif">
                                                                                    '.$serviceNow.'<o:p></o:p>
                                                                                    </span>
                                                                                </i>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="mso-yfti-irow:4;height:24.35pt">
                                                                        <td width="316" valign="top" style="width:237.05pt;
                                                                            border:solid #BFBFBF 1.0pt;
                                                                            border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:24.35pt">
                                                                            <p class="MsoNormal" style="mso-element:frame;
                                                                                mso-element-frame-hspace:9.0pt;
                                                                                mso-element-wrap:around;
                                                                                mso-element-anchor-vertical:paragraph;
                                                                                mso-element-anchor-horizontal:column;mso-height-rule:exactly">
                                                                                <span style="font-family:&quot;Tahoma&quot;,sans-serif">
                                                                                Краткое описание (что произошло, выполняемые действия, 
                                                                                причины аварии, номер обращения оформленной у внешних поставщиков сервиса):<o:p></o:p>
                                                                                </span>
                                                                            </p>
                                                                        </td>
                                                                        <td width="255" valign="top" style="width:191.6pt;
                                                                            border-top:none;
                                                                            border-left:none;
                                                                            border-bottom:solid #BFBFBF 1.0pt;
                                                                            border-right:solid #BFBFBF 1.0pt;
                                                                            padding:0cm 5.4pt 0cm 5.4pt;height:24.35pt">
                                                                            <p class="MsoNormal">
                                                                                <i>
                                                                                    <span style="font-family:&quot;Tahoma&quot;,sans-serif">'.$model->message.'<o:p></o:p>
                                                                                    </span>
                                                                                </i>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="mso-yfti-irow:5;height:27.4pt">
                                                                        <td width="316" valign="top" style="width:237.05pt;border:solid #BFBFBF 1.0pt;
                                                                        border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:27.4pt">
                                                                            <p class="MsoNormal" style="mso-element:frame;
                                                                                mso-element-frame-hspace:9.0pt;
                                                                                mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                                mso-element-anchor-horizontal:column;mso-height-rule:exactly">
                                                                                <span style="font-family:&quot;Tahoma&quot;,sans-serif">Ответственный за устранение:<o:p></o:p>
                                                                                </span>
                                                                            </p>
                                                                        </td>
                                                                        <td width="255" valign="top" style="width:191.6pt;border-top:none;
                                                                        border-left:none;border-bottom:solid #BFBFBF 1.0pt;border-right:solid #BFBFBF 1.0pt;
                                                                        padding:0cm 5.4pt 0cm 5.4pt;height:27.4pt">
                                                                            <p class="MsoNormal">
                                                                                <i>
                                                                                    <span style="font-family:&quot;Tahoma&quot;,sans-serif">'.$model->res_person.'<o:p></o:p>
                                                                                    </span>
                                                                                </i>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                    <tr style="mso-yfti-irow:6;mso-yfti-lastrow:yes;height:13.45pt">
                                                                        <td width="316" valign="top" style="width:237.05pt;border:solid #BFBFBF 1.0pt;
                                                                            border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:13.45pt">
                                                                            <p class="MsoNormal" style="mso-element:frame;
                                                                                mso-element-frame-hspace:9.0pt;
                                                                                mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                                mso-element-anchor-horizontal:column;mso-height-rule:exactly">
                                                                                <span style="font-family:&quot;Tahoma&quot;,sans-serif">Контроль за устранением:<o:p></o:p>
                                                                                </span>
                                                                            </p>
                                                                        </td>
                                                                        <td width="255" valign="top" style="width:191.6pt;border-top:none;
                                                                            border-left:none;border-bottom:solid #BFBFBF 1.0pt;border-right:solid #BFBFBF 1.0pt;
                                                                            padding:0cm 5.4pt 0cm 5.4pt;height:13.45pt">
                                                                            <p class="MsoNormal">
                                                                                <i>
                                                                                    <span style="font-family:&quot;Tahoma&quot;,sans-serif">'.$model->super_person.'<o:p></o:p>
                                                                                    </span>
                                                                                </i>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                mso-fareast-language:RU"><o:p>&nbsp;</o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    mso-fareast-language:RU"><o:p>&nbsp;</o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    mso-fareast-language:RU"><o:p>&nbsp;</o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    mso-fareast-language:RU">С уважением,<o:p></o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><b><span
                                                                    style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif">Направление
                                                                    по поддержке мониторинга инфраструктуры<o:p></o:p></span></b></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><b><span
                                                                    style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    mso-fareast-language:RU"><o:p>&nbsp;</o:p></span></b></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    style="mso-fareast-language:RU"><img border=0 width=195 height=71
                                                                    src="'.$path.'/image005.gif" style="height:.739in;width:2.031in"
                                                                    alt="NORNICKEL_ОЦО_hor_rus"></span><span
                                                                    style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    mso-fareast-language:RU"><o:p></o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    color:#5E5F61"><o:p>&nbsp;</o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    color:#5E5F61">ООО «Норникель – Общий центр обслуживания»<o:p></o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    color:#5E5F61">Московская ул., д. 113/117, г. Саратов, Россия, 410600<o:p></o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    color:#5E5F61">тел.&nbsp; +7 495 787-76-67 доб. 73-77<o:p></o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    color:#5E5F61">тел.&nbsp; +7 917 201-73-77<o:p></o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    lang=EN-US style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    mso-ansi-language:EN-US;mso-fareast-language:RU"><a
                                                                    href="mailto:itmonitoring@nornik.ru">itmonitoring<span lang=RU
                                                                    style="mso-ansi-language:RU">@</span>nornik<span lang=RU
                                                                    style="mso-ansi-language:RU">.</span>ru</a> </span><span
                                                                    style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    mso-fareast-language:RU"><o:p></o:p></span></p>
                                                                <p class=MsoNormal style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
                                                                    9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                                                                    mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span
                                                                    lang=EN-US style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    mso-ansi-language:EN-US;mso-fareast-language:RU"><a
                                                                    href="ssc.nornik.ru">ssc<span lang=RU
                                                                    style="mso-ansi-language:RU">.nornik</span>nornik<span lang=RU
                                                                    style="mso-ansi-language:RU">.</span>ru</a> </span><span
                                                                    style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
                                                                    mso-fareast-language:RU"><o:p></o:p></span></p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>';
        return $text;
    }
}    