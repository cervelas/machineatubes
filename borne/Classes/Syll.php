<?php

class Syll
{
    private $vowels = ['a', 'à', 'â', 'ä', 'e', 'é', 'è', 'ë', 'ê', 'i', 'î', 'o', 'ô', 'ö', 'u', 'ù', 'û', 'ü','h'];
    private $inseparables = ['bl','br','ch','cl','cr','dr','fl','fr','gl','gn','gr','pl','ph','pr','th','tr','vr'];
    private $consonants = ['b', 'c', 'ç', 'd', 'f', 'g', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'];
    private $punctuation = ['.', ',', ':', ';', '"', '!', '?'];
    private $separators = ['-'];
    private $skip_next = false;

    public function syllTxt($txt)
    {
        $txt = str_replace($this->separators, ' ', $txt);
        $words_arr = explode(' ', mb_strtolower($txt));
        foreach ($words_arr as $key => $word) {
            $tmp_syll = '';
            $thisword = str_replace($this->punctuation, '', $word);
            echo ' ';
            if (mb_strlen($thisword) >= 4) {
                //we only separate them if they have more than 4 letters
                $letters = mb_str_split($thisword, 1);
                $letters = array_reverse($letters);
                foreach ($letters as $letter_pos => $letter) {
                    if (in_array($letter, $this->vowels)) {
                        $tmp_syll = $letter . $tmp_syll;
                        if ($letter_pos == (mb_strlen($thisword) - 1)) {
                            //cest la premiere lettre du mot
                            $word_sylls_rev[] = $tmp_syll;
                            $tmp_syll = '';
                            $word_sylls[] = array_reverse($word_sylls_rev);
                            unset($word_sylls_rev);
                        }
                    } elseif (in_array($letter, $this->consonants)) {
                        if ($letter_pos == 0) {
                            //verifier si cest la derniere lettre du mot
                            $tmp_syll = $letter;
                        } elseif ($letter_pos == (mb_strlen($thisword) - 1)) {
                            //verifier si cest la premiere lettre du mot
                            //si elle n'a pas un skip, on la met, sinon on ferme la syllabe directement
                            if(!$this->skip_next){
                                $tmp_syll = $letter.$tmp_syll;
                            }else{
                                $this->skip_next = false;
                            }
                            $word_sylls_rev[] = $tmp_syll;
                            $tmp_syll = '';
                            $word_sylls[] = array_reverse($word_sylls_rev);
                            unset($word_sylls_rev);
                        } else {
                            //cest pas la derniere ni la premiere lettre du mot
                            //si la lettre d'apres est une voyelle
                            if(in_array($letters[$letter_pos-1], $this->vowels)){
                                $two_letters = $letters[$letter_pos+1].$letter;
                                // si c'est un combo inseparable
                                if(in_array($two_letters, $this->inseparables)){
                                    $tmp_syll = $two_letters.$tmp_syll;
                                    $word_sylls_rev[] = $tmp_syll;
                                    $tmp_syll = '';
                                    $this->skip_next = true;
                                }else{
                                    $tmp_syll = $letter.$tmp_syll;
                                    $word_sylls_rev[] = $tmp_syll;
                                    $tmp_syll = '';
                                }
                            }else{
                                if(!$this->skip_next){
                                    $tmp_syll = $letter.$tmp_syll;
                                }else{
                                    $this->skip_next = false;
                                }
                            }
                        }
                    } else {
                        //si cest un chiffre
                        $tmp_syll = $letter . $tmp_syll;
                    }
                }
            } else {
                //si le mot nest pas separe, on le met en entier dans les syllabes
                $word_sylls[] = $thisword;

            }
        }

        return $word_sylls;
    }
}