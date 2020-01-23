<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Punchlines extends Model
{

    public static  function getPunchLine($temp,$type)
    {
        $skin_options['mother']['temp_1_text'] = 'Μην κουνηθείς σήμερα ότι θέλεις θα στο φέρει η μαμά';  //full cold
        $skin_options['mother']['temp_2_text'] = 'Ντύσου καλά σήμερα να βάλεις το κασκόλ που σου έπλεξα';  //cold
        $skin_options['mother']['temp_3_text'] = 'Μην ξεχάσεις τη ζακέτα σου κυκλοφορεί ίωση';  //normal
        $skin_options['mother']['temp_4_text'] = 'Να σκεπάζεσαι με ένα σεντόνι το βράδυ';  //hot
        $skin_options['mother']['temp_5_text'] = 'Μην κάθεσαι κάτω από το aircondition θα την αρπάξεις';  //too hot
        $skin_options['mother']['temp_1_subtitle'] = 'σε δέκα λεπτά θα είμαι εκεί';
        $skin_options['mother']['temp_2_subtitle'] = 'είναι στο δεύτερο συρτάρι';
        $skin_options['mother']['temp_3_subtitle'] = 'έρχομαι να σου στύψω χυμό πορτοκάλι';
        $skin_options['mother']['temp_4_subtitle'] = 'γιατί θα την αρπάξεις';
        $skin_options['mother']['temp_5_subtitle'] = 'έχει γεμιστά στο ψυγείο';
        $skin_options['mother']['temp_1_smalltitle'] = 'μήν κουνηθείς';
        $skin_options['mother']['temp_2_smalltitle'] = 'κασκόλ γάντια';
        $skin_options['mother']['temp_3_smalltitle'] = 'βάλε ζακέτα';
        $skin_options['mother']['temp_4_smalltitle'] = 'σεντόνι';
        $skin_options['mother']['temp_5_smalltitle'] = 'γεμιστά στο ψυγείο';
        $skin_options['friend']['temp_1_text'] = 'Έχει ψοφόκρυο σήμερα να έρθω να πιούμε καμιά μπύρα;';
        $skin_options['friend']['temp_2_text'] = 'Έχει κρυο σήμερα να έρθω να πιούμε καμιά μπύρα;';
        $skin_options['friend']['temp_3_text'] = 'Έχει καλό καιρό σήμερα να έρθω να πιούμε καμιά μπύρα;';
        $skin_options['friend']['temp_4_text'] = 'Ζέστη σήμερα θα έρθω για καμια μπύρα στο μπαλκόνι';
        $skin_options['friend']['temp_5_text'] = 'Άναψε aircondition στο full ερχομαι για καμια μπύρα';
        $skin_options['friend']['temp_1_subtitle'] = 'και να παίξουμε PS4';
        $skin_options['friend']['temp_2_subtitle'] = 'και να παίξουμε PS4';
        $skin_options['friend']['temp_3_subtitle'] = 'και να παίξουμε PS4';
        $skin_options['friend']['temp_4_subtitle'] = 'και να παίξουμε PS4';
        $skin_options['friend']['temp_5_subtitle'] = 'και να παίξουμε PS4';
        $skin_options['friend']['temp_1_smalltitle'] = 'Μπυρα & PS4';
        $skin_options['friend']['temp_2_smalltitle'] = 'Μπυρα & PS4';
        $skin_options['friend']['temp_3_smalltitle'] = 'Μπυρα & PS4';
        $skin_options['friend']['temp_4_smalltitle'] = 'Μπυρα & PS4';
        $skin_options['friend']['temp_5_smalltitle'] = 'Μπυρα & PS4';
        $skin_options['bank']['temp_1_text'] = 'Ο λογαριασμός σου είναι σαν τον καιρό που έχει έξω';
        $skin_options['bank']['temp_2_text'] = 'Πετρελαιάκι δεν βλέπω να βάζουμε φέτος';
        $skin_options['bank']['temp_3_text'] = 'O καιρός είναι καλός αλλά το ταμείο μείον';
        $skin_options['bank']['temp_4_text'] = 'Ο καιρός είναι ότι πρέπει για ένα ταξίδι';
        $skin_options['bank']['temp_5_text'] = 'Οι γονείς σου πρόλαβαν διακοποδάνειο εσύ;';
        $skin_options['bank']['temp_1_subtitle'] = 'πλήρωσε την κάρτα για να μην βρεθείς και εσύ εκεί';
        $skin_options['bank']['temp_2_subtitle'] = 'και το ΠΑΣΟΚ αργεί να έρθει';
        $skin_options['bank']['temp_3_subtitle'] = 'κάτσε σπίτι σήμερα';
        $skin_options['bank']['temp_4_subtitle'] = 'αλλά όχι για σένα';
        $skin_options['bank']['temp_5_subtitle'] = 'μάλλον όχι';
        $skin_options['bank']['temp_1_smalltitle'] = 'Αποταμίευση';
        $skin_options['bank']['temp_2_smalltitle'] = 'Αποταμίευση';
        $skin_options['bank']['temp_3_smalltitle'] = 'Αποταμίευση';
        $skin_options['bank']['temp_4_smalltitle'] = 'Αποταμίευση';
        $skin_options['bank']['temp_5_smalltitle'] = 'Αποταμίευση';
        $skin_options['tv']['temp_1_text'] = 'Ακραία καιρικά φαινόμενα σίγουρα έχουν πεθάνει 100 μέχρι τώρα';
        $skin_options['tv']['temp_2_text'] = 'Επέλαση του χιονιά δέκα εκατοστά χιόνι στον όλυμπο';
        $skin_options['tv']['temp_3_text'] = 'Έξαρση της γρίπης H100N1000 σε έλλειψη τα εμβόλια';
        $skin_options['tv']['temp_4_text'] = 'Καύσωνας στην Αφρική ο οποίος επηρρεάζει την Ελλάδα';
        $skin_options['tv']['temp_5_text'] = 'Καμίνι η Ελλάδα σήμερα 60 βαθμούς βούλιαξαν οι παραλίες';
        $skin_options['tv']['temp_1_subtitle'] = 'κλειστά σχολεία για όλο το χειμώνα';
        $skin_options['tv']['temp_2_subtitle'] = 'στα ύψη το πετρέλαιο';
        $skin_options['tv']['temp_3_subtitle'] = 'αγοράστε πριν είναι αργά';
        $skin_options['tv']['temp_4_subtitle'] = 'ανοίξτε aircondition στο τέρμα';
        $skin_options['tv']['temp_5_subtitle'] = 'στα ύψη ο υδράργυρος';
        $skin_options['tv']['temp_1_smalltitle'] = 'κλειστά σχολεία';
        $skin_options['tv']['temp_2_smalltitle'] = 'κλειστά σχολεία';
        $skin_options['tv']['temp_3_smalltitle'] = 'εμβολιαστείτε';
        $skin_options['tv']['temp_4_smalltitle'] = 'full aircondition';
        $skin_options['tv']['temp_5_smalltitle'] = 'κόβονται συντάξεις';


        $skin = session('skin', 'mother');
        if($temp < 0)
        {
            if($type == 'text')
                return $skin_options[$skin]['temp_1_text'];
            if($type == 'sub')
                return $skin_options[$skin]['temp_1_subtitle'];
            if($type == 'small')
                return $skin_options[$skin]['temp_1_smalltitle'];
        }
        if($temp >= 0 && $temp < 10)
        {
            if($type == 'text')
                return $skin_options[$skin]['temp_2_text'];
            if($type == 'sub')
                return $skin_options[$skin]['temp_2_subtitle'];
            if($type == 'small')
                return $skin_options[$skin]['temp_2_smalltitle'];
        }
        if($temp >= 10 && $temp < 20)
        {
            if($type == 'text')
                return $skin_options[$skin]['temp_3_text'];
            if($type == 'sub')
                return $skin_options[$skin]['temp_3_subtitle'];
            if($type == 'small')
                return $skin_options[$skin]['temp_3_smalltitle'];
        }
        if($temp >= 20 && $temp < 30)
        {
            if ($type == 'text')
                return $skin_options[$skin]['temp_4_text'];
            if ($type == 'sub')
                return $skin_options[$skin]['temp_4_subtitle'];
            if ($type == 'small')
                return $skin_options[$skin]['temp_4_smalltitle'];

            if ($temp >= 30) {
                if ($type == 'text')
                    return $skin_options[$skin]['temp_5_text'];
                if ($type == 'sub')
                    return $skin_options[$skin]['temp_5_subtitle'];
                if ($type == 'small')
                    return $skin_options[$skin]['temp_5_smalltitle'];
            }
        }
    }
}
