#!/usr/bin/env python3
"""
SheCare Decision Tree - ID3 Algorithm
Receives JSON input via stdin and outputs diagnosis result
"""

import sys
import json
import math
from collections import Counter

class DecisionTree:
    def __init__(self):
        self.tree = None
    
    def entropy(self, data):
        """Calculate entropy of dataset"""
        if not data:
            return 0
        
        label_counts = Counter([item['label'] for item in data])
        total = len(data)
        
        entropy_val = 0
        for count in label_counts.values():
            if count > 0:
                probability = count / total
                entropy_val -= probability * math.log2(probability)
        
        return entropy_val
    
    def information_gain(self, data, attribute):
        """Calculate information gain for an attribute"""
        total_entropy = self.entropy(data)
        
        # Split data by attribute values
        subsets = {}
        for item in data:
            value = item[attribute]
            if value not in subsets:
                subsets[value] = []
            subsets[value].append(item)
        
        # Calculate weighted entropy
        weighted_entropy = 0
        total = len(data)
        
        for subset in subsets.values():
            probability = len(subset) / total
            weighted_entropy += probability * self.entropy(subset)
        
        return total_entropy - weighted_entropy
    
    def classify(self, answers):
        """
        Classify based on answers using rule-based decision tree
        
        Decision Tree Structure:
        Root: Nyeri panggul kronis?
        ├─ Tidak (<=2)
        │  └─ Keputihan abnormal?
        │     ├─ Ya (>=3)
        │     │  └─ Gatal/Iritasi?
        │     │     ├─ Ya (>=3) → Infeksi Jamur
        │     │     └─ Tidak (<=2) → Infeksi Bakteri
        │     └─ Tidak (<=2) → Normal
        └─ Ya (>=3)
           └─ Keputihan abnormal?
              ├─ Tidak (<=2) → Endometriosis
              └─ Ya (>=3) → PID
        """
        
        # Extract answer values
        answer_map = {int(ans['question_id']): int(ans['answer_value']) for ans in answers}
        
        # Assuming standard question IDs:
        # 1: Nyeri panggul kronis (1-5)
        # 2: Keputihan abnormal (1-5)
        # 3: Gatal/Iritasi (1-5)
        
        nyeri_panggul = answer_map.get(1, 0)
        keputihan_abnormal = answer_map.get(2, 0)
        gatal_iritasi = answer_map.get(3, 0)
        
        # Apply decision tree logic
        if nyeri_panggul <= 2:
            # No chronic pelvic pain
            if keputihan_abnormal >= 3:
                # Abnormal discharge
                if gatal_iritasi >= 3:
                    # With itching -> Fungal Infection
                    return {
                        'disease_id': 2,
                        'disease_name': 'Infeksi Jamur (Kandidiasis)',
                        'confidence': 0.85,
                        'diagnosis_text': 'Berdasarkan gejala keputihan abnormal dengan gatal dan iritasi, kemungkinan besar Anda mengalami infeksi jamur vagina (kandidiasis).',
                        'recommendations': 'Gunakan obat antijamur topikal atau oral, jaga kebersihan area kewanitaan, hindari pakaian ketat dan sintetis, konsumsi yogurt probiotik. Konsultasi dengan dokter jika gejala tidak membaik dalam 3-5 hari.'
                    }
                else:
                    # Without significant itching -> Bacterial Infection
                    return {
                        'disease_id': 3,
                        'disease_name': 'Infeksi Bakteri (Bacterial Vaginosis)',
                        'confidence': 0.75,
                        'diagnosis_text': 'Gejala keputihan abnormal tanpa gatal yang signifikan mengindikasikan kemungkinan infeksi bakteri pada vagina (bacterial vaginosis).',
                        'recommendations': 'Konsultasi dokter untuk mendapatkan antibiotik yang tepat, jaga pH vagina dengan sabun khusus, hindari douching, gunakan pakaian dalam berbahan katun.'
                    }
            else:
                # No abnormal discharge -> Normal
                return {
                    'disease_id': 5,
                    'disease_name': 'Normal',
                    'confidence': 0.90,
                    'diagnosis_text': 'Berdasarkan gejala yang dilaporkan, tidak ditemukan indikasi penyakit yang signifikan. Kondisi kesehatan reproduksi Anda tampak normal.',
                    'recommendations': 'Lakukan pemeriksaan rutin setiap 6-12 bulan, jaga pola hidup sehat, konsumsi makanan bergizi, olahraga teratur, dan kelola stres dengan baik.'
                }
        else:
            # Chronic pelvic pain present
            if keputihan_abnormal <= 2:
                # No significant discharge -> Endometriosis
                return {
                    'disease_id': 1,
                    'disease_name': 'Endometriosis',
                    'confidence': 0.80,
                    'diagnosis_text': 'Nyeri panggul kronis yang Anda alami tanpa keputihan abnormal yang signifikan mengindikasikan kemungkinan endometriosis, kondisi dimana jaringan mirip lapisan rahim tumbuh di luar rahim.',
                    'recommendations': 'Segera konsultasi dengan dokter spesialis kandungan untuk pemeriksaan lebih lanjut (USG transvaginal/laparoskopi), pertimbangkan terapi hormon, dan diskusikan opsi pengelolaan nyeri dengan dokter.'
                }
            else:
                # With abnormal discharge -> PID
                return {
                    'disease_id': 4,
                    'disease_name': 'PID (Pelvic Inflammatory Disease)',
                    'confidence': 0.70,
                    'diagnosis_text': 'Kombinasi nyeri panggul kronis dan keputihan abnormal mengindikasikan kemungkinan penyakit radang panggul (PID), infeksi pada organ reproduksi yang memerlukan penanganan segera.',
                    'recommendations': 'SEGERA konsultasi dengan dokter untuk mendapatkan antibiotik yang tepat, istirahat total, hindari hubungan seksual selama pengobatan, dan lakukan pemeriksaan lanjutan untuk memastikan infeksi teratasi.'
                }

def main():
    try:
        # Read input from stdin
        input_data = sys.stdin.read()
        data = json.loads(input_data)
        
        # Initialize decision tree
        dt = DecisionTree()
        
        # Get answers
        answers = data.get('answers', [])
        
        if not answers:
            result = {
                'error': 'No answers provided',
                'disease_id': None,
                'confidence': 0
            }
        else:
            # Classify
            result = dt.classify(answers)
        
        # Output result as JSON
        print(json.dumps(result, ensure_ascii=False))
        
    except Exception as e:
        error_result = {
            'error': str(e),
            'disease_id': None,
            'confidence': 0
        }
        print(json.dumps(error_result))
        sys.exit(1)

if __name__ == '__main__':
    main()