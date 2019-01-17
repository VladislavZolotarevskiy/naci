<?php 
namespace frontend\controllers;
use frontend\models\IncidentRefService;


class IncidentStepsMailController extends SiteController
{
    function mailCreate($model,$title) {
        $services_model = IncidentRefService::find()->where(['incident_id' => $model->incident_id])->with('refService')->all();
        $services = '';
        foreach ($services_model as $service){
            $services .= $service->refService->name.', ';
        }
        $path = \yii\helpers\Url::toRoute(['/img'], 'http').'/'.sha1('o4kotvoeimamashi' );
        
        $text = 
            '<table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" align="left" width="0" 
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
                                    width:6.291in" v:shapes="Рисунок_x0020_16">
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
                <td width="316" valign="top" style="width:237.05pt;border:solid #BFBFBF 1.0pt;
                border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:22.15pt">
                <p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:
                9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Время начала инцидента:<o:p></o:p></span></p>
                </td>
                <td width="255" valign="top" style="width:191.6pt;border-top:none;
                border-left:none;border-bottom:solid #BFBFBF 1.0pt;border-right:solid #BFBFBF 1.0pt;
                padding:0cm 5.4pt 0cm 5.4pt;height:22.15pt">
                <p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:
                9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                mso-element-anchor-horizontal:column;mso-height-rule:exactly"><i><span style="font-family:&quot;Tahoma&quot;,sans-serif">23.11 в 08:03(MCK)<o:p></o:p></span></i></p>
                </td>
               </tr>
               <tr style="mso-yfti-irow:2;height:21.95pt">
                <td width="316" valign="top" style="width:237.05pt;border:solid #BFBFBF 1.0pt;
                border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:21.95pt">
                <p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:
                9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Планируемое время окончания
                инцидента:<o:p></o:p></span></p>
                </td>
                <td width="255" valign="top" style="width:191.6pt;border-top:none;
                border-left:none;border-bottom:solid #BFBFBF 1.0pt;border-right:solid #BFBFBF 1.0pt;
                padding:0cm 5.4pt 0cm 5.4pt;height:21.95pt"></td>
               </tr>
               <tr style="mso-yfti-irow:3;height:22.5pt">
                <td width="316" valign="top" style="width:237.05pt;border:solid #BFBFBF 1.0pt;
                border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:22.5pt">
                <p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:
                9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Номер инцидента в ServiceNow:<o:p></o:p></span></p>
                </td>
                <td width="255" valign="top" style="width:191.6pt;border-top:none;
                border-left:none;border-bottom:solid #BFBFBF 1.0pt;border-right:solid #BFBFBF 1.0pt;
                padding:0cm 5.4pt 0cm 5.4pt;height:22.5pt"></td>
               </tr>
               <tr style="mso-yfti-irow:4;height:24.35pt">
                <td width="316" valign="top" style="width:237.05pt;border:solid #BFBFBF 1.0pt;
                border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:24.35pt">
                <p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:
                9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Краткое описание (что
                произошло, выполняемые действия, причины аварии, номер обращения
                оформленной у внешних поставщиков сервиса):<o:p></o:p></span></p>
                </td>
                <td width="255" valign="top" style="width:191.6pt;border-top:none;
                border-left:none;border-bottom:solid #BFBFBF 1.0pt;border-right:solid #BFBFBF 1.0pt;
                padding:0cm 5.4pt 0cm 5.4pt;height:24.35pt">
                <p class="MsoNormal"><i><span style="font-family:&quot;Tahoma&quot;,sans-serif">Наблюдаются
                проблемы с авторизацией на рабочих станциях. Причины выясняются.<o:p></o:p></span></i></p>
                </td>
               </tr>
               <tr style="mso-yfti-irow:5;height:27.4pt">
                <td width="316" valign="top" style="width:237.05pt;border:solid #BFBFBF 1.0pt;
                border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:27.4pt">
                <p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:
                9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Ответственный за устранение:<o:p></o:p></span></p>
                </td>
                <td width="255" valign="top" style="width:191.6pt;border-top:none;
                border-left:none;border-bottom:solid #BFBFBF 1.0pt;border-right:solid #BFBFBF 1.0pt;
                padding:0cm 5.4pt 0cm 5.4pt;height:27.4pt">
                <p class="MsoNormal"><i><span style="font-family:&quot;Tahoma&quot;,sans-serif">Каргашин
                Д.А.<o:p></o:p></span></i></p>
                </td>
               </tr>
               <tr style="mso-yfti-irow:6;mso-yfti-lastrow:yes;height:13.45pt">
                <td width="316" valign="top" style="width:237.05pt;border:solid #BFBFBF 1.0pt;
                border-top:none;padding:0cm 5.4pt 0cm 5.4pt;height:13.45pt">
                <p class="MsoNormal" style="mso-element:frame;mso-element-frame-hspace:
                9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
                mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-family:&quot;Tahoma&quot;,sans-serif">Контроль за устранением:<o:p></o:p></span></p>
                </td>
                <td width="255" valign="top" style="width:191.6pt;border-top:none;
                border-left:none;border-bottom:solid #BFBFBF 1.0pt;border-right:solid #BFBFBF 1.0pt;
                padding:0cm 5.4pt 0cm 5.4pt;height:13.45pt">
                <p class="MsoNormal"><i><span style="font-family:&quot;Tahoma&quot;,sans-serif">Луцков
                А.А.<o:p></o:p></span></i></p>
                </td>
               </tr>
              </tbody></table>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              mso-fareast-language:RU"><o:p>&nbsp;</o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              mso-fareast-language:RU"><o:p>&nbsp;</o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              mso-fareast-language:RU"><o:p>&nbsp;</o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              mso-fareast-language:RU">С уважением,<o:p></o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><b><span style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif">Направление
              поддержки мониторинга инфраструктуры<o:p></o:p></span></b></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><b><span style="font-size:10.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              mso-fareast-language:RU"><o:p>&nbsp;</o:p></span></b></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="mso-fareast-language:RU"><!--[if gte vml 1]><v:shape id="Рисунок_x0020_18"
               o:spid="_x0000_i1027" type="#_x0000_t75" alt="NORNICKEL_ОЦО_hor_rus"
               style="width:146.25pt;height:53.25pt">
               <v:imagedata src="Открытие%20кризисного%20ИТ%20инцидента%20№244.files/image004.png"
                o:href="cid:image003.png@01D3969D.5DE5A7C0"/>
              </v:shape><![endif]--><!--[if !vml]--><img width="195" height="71" src="Открытие%20кризисного%20ИТ%20инцидента%20№244.files/image005.gif" style="height:.739in;width:2.031in" alt="NORNICKEL_ОЦО_hor_rus" v:shapes="Рисунок_x0020_18"><!--[endif]--></span><span style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              mso-fareast-language:RU"><o:p></o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              color:#5E5F61"><o:p>&nbsp;</o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              color:#5E5F61">ООО «Норникель – Общий центр обслуживания»<o:p></o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              color:#5E5F61">Московская ул., д. 113/117, г. Саратов, Россия, 410600<o:p></o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              color:#5E5F61">тел.&nbsp; +7 495 787-76-67 доб. 73-77<o:p></o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><span style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              color:#5E5F61">моб. </span><span style="font-size:8.0pt;line-height:105%;
              font-family:&quot;Tahoma&quot;,sans-serif;color:#5E5F61;mso-fareast-language:RU">+7</span><span style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              color:#5E5F61">&nbsp;</span><span style="font-size:8.0pt;line-height:
              105%;font-family:&quot;Tahoma&quot;,sans-serif;color:#5E5F61;mso-fareast-language:
              RU">987</span><span style="font-size:8.0pt;line-height:105%;font-family:
              &quot;Tahoma&quot;,sans-serif;color:#5E5F61">&nbsp;</span><span style="font-size:
              8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;color:#5E5F61;
              mso-fareast-language:RU">324</span><span style="font-size:8.0pt;
              line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;color:#5E5F61">-</span><span style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              color:#5E5F61;mso-fareast-language:RU">24</span><span style="font-size:
              8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;color:#5E5F61">-</span><span style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              color:#5E5F61;mso-fareast-language:RU">04</span><span style="font-size:
              8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;color:#5E5F61"><o:p></o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><a href="mailto:ITMonitoring@nornik.ru"><span lang="EN-US" style="font-size:
              8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;mso-ansi-language:
              EN-US">ITMonitoring</span><span style="font-size:8.0pt;line-height:105%;
              font-family:&quot;Tahoma&quot;,sans-serif">@</span><span lang="EN-US" style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              mso-ansi-language:EN-US">nornik</span><span style="font-size:8.0pt;
              line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif">.</span><span lang="EN-US" style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              mso-ansi-language:EN-US">ru</span></a><span style="font-size:8.0pt;
              line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;mso-fareast-language:
              RU"><o:p></o:p></span></p>
              <p class="MsoNormal" style="line-height:105%;mso-element:frame;mso-element-frame-hspace:
              9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:paragraph;
              mso-element-anchor-horizontal:column;mso-height-rule:exactly"><a href="ssc.nornik.ru"><span lang="EN-US" style="font-size:8.0pt;line-height:
              105%;font-family:&quot;Tahoma&quot;,sans-serif;mso-ansi-language:EN-US;mso-fareast-language:
              RU">ssc</span><span style="font-size:8.0pt;line-height:105%;font-family:
              &quot;Tahoma&quot;,sans-serif;mso-fareast-language:RU">.</span><span lang="EN-US" style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              mso-ansi-language:EN-US;mso-fareast-language:RU">nornik</span><span style="font-size:8.0pt;line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;
              mso-fareast-language:RU">.</span><span lang="EN-US" style="font-size:8.0pt;
              line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;mso-ansi-language:EN-US;
              mso-fareast-language:RU">ru</span></a><span style="font-size:8.0pt;
              line-height:105%;font-family:&quot;Tahoma&quot;,sans-serif;mso-fareast-language:
              RU"> </span><span style="font-size:10.0pt;line-height:105%;font-family:
              &quot;Tahoma&quot;,sans-serif"><o:p></o:p></span></p>
              </td>
             </tr>
            </tbody></table>
            </td>
           </tr>
          </tbody></table>
          </td>
         </tr>
        </tbody></table>';
        return $text;
    }
}    