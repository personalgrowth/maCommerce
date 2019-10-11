<?php
function litimgurls($imgid=0)
{
    global $lit_imglist,$dsql;
    //获取附加表
    $row = $dsql->GetOne("SELECT c.addtable FROM #@__archives AS a LEFT JOIN #@__channeltype AS c 
                                                            ON a.channel=c.id where a.id='$imgid'");
    $addtable = trim($row['addtable']);
    
    //获取图片附加表imgurls字段内容进行处理
    $row = $dsql->GetOne("Select imgurls From `$addtable` where aid='$imgid'");
    
    //调用inc_channel_unit.php中ChannelUnit类
    $ChannelUnit = new ChannelUnit(2,$imgid);
    
    //调用ChannelUnit类中GetlitImgLinks方法处理缩略图
    $lit_imglist = $ChannelUnit->GetlitImgLinks($row['imgurls']);
    
    //返回结果
    return $lit_imglist;
}
function GetOneImgUrl($img,$ftype=1){  
    if($img <> ''){  
        $dtp = new DedeTagParse();  
        $dtp->LoadSource($img);  
        if(is_array($dtp->CTags)){  
            foreach($dtp->CTags as $ctag){  
                if($ctag->GetName()=='img'){  
                    $width = $ctag->GetAtt('width');  
                    $height = $ctag->GetAtt('height');  
                    $imgurl = trim($ctag->GetInnerText());  
                    $img = '';  
                    if($imgurl != ''){  
                        if($ftype==1){  
                            $img .= $imgurl;  
                        }  
                        else{  
                            $img .= '<img src="'.$imgurl.'" width="'.$width.'" height="'.$height.'" />';  
                        }  
                    }  
                }  
            }  
        }  
        $dtp->Clear();  
        return $img;      
    }  
}
/**
 *  加载自定义模板
 *
 * @access    public
 * @param     string  $path  模板文件名
 */
function pasterTempletDiy($path)
{
    require_once(DEDEINC."/arc.partview.class.php");
    global $cfg_basedir,$cfg_templets_dir,$cfg_df_style;
    $tmpfile = $cfg_basedir.$cfg_templets_dir.'/'.$cfg_df_style.'/m_'.$path.'.html';
    $dtp = new PartView();
    $dtp->SetTemplet($tmpfile);
    return $dtp->GetResult();
}