<template>
    <div style="display: grid; place-items: center; height: 100vh">
        <el-row justify="center" style="display: contents">
            <el-col :xs="24" :sm="14" :md="10" :lg="7" :xl="5">
                <el-form
                    ref="ruleFormRef"
                    :model="ruleForm"
                    :rules="rules"
                    label-width="120px"
                    class="demo-ruleForm"
                    status-icon
                >
                    <el-form-item label="Activity name" prop="name">
                        <el-input v-model="ruleForm.name" />
                    </el-form-item>
                    <el-form-item>
                        <el-button
                            type="primary"
                            @click="submitForm(ruleFormRef)"
                        >
                            Create
                        </el-button>
                        <el-button @click="resetForm(ruleFormRef)"
                            >Cancel</el-button
                        >
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
</template>

<script lang="ts" setup>
import { reactive, ref } from "vue";
import type { FormInstance, FormRules } from "element-plus";

interface RuleForm {
    name: string;
}

const ruleFormRef = ref<FormInstance>();
const ruleForm = reactive<RuleForm>({
    name: "",
});

const rules = reactive<FormRules<RuleForm>>({
    name: [
        {
            required: true,
            message: "Please input Activity name",
            trigger: "blur",
        },
        { min: 3, max: 5, message: "Length should be 3 to 5", trigger: "blur" },
    ],
});

const submitForm = async (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    await formEl.validate((valid, fields) => {
        if (valid) {
            console.log("submit!");
        } else {
            console.log("error submit!", fields);
        }
    });
};

const resetForm = (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    formEl.resetFields();
};
</script>
