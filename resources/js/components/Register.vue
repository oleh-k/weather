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
                    <el-form-item label="Name" prop="name">
                        <el-input v-model="ruleForm.name" />
                    </el-form-item>
                    <el-form-item label="Email" prop="email">
                        <el-input v-model="ruleForm.email" />
                    </el-form-item>
                    <el-form-item label="Password" prop="password">
                        <el-input type="password" v-model="ruleForm.password" />
                    </el-form-item>
                    <el-form-item
                        label="Confirm password"
                        prop="password_confirmation"
                    >
                        <el-input
                            type="password"
                            v-model="ruleForm.password_confirmation"
                        />
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
import { ElMessage } from "element-plus";
import { useStore } from "vuex";

const store = useStore();

interface RuleForm {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
}

const ruleFormRef = ref<FormInstance>();
const ruleForm = reactive<RuleForm>({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

interface Test {
    token: string;
}


const password_confirmation = (rule: any, value: any, callback: any) => {
    if (value === "") {
        callback(new Error("Please input the password again"));
    } else if (value !== ruleForm.password) {
        callback(new Error("Two inputs don't match!"));
    } else {
        callback();
    }
};
const submitForm = async (formEl) => {
    if (!formEl) return;
    try {
        await formEl.validate();
        const data = {
            name: ruleForm.name,
            email: ruleForm.email,
            password: ruleForm.password,
            password_confirmation: ruleForm.password_confirmation,
        };
        const response = await axios.post("/api/register", data);
        if (response.data.success == true) {
            ElMessage({
                showClose: true,
                message: "success",
                type: "success",
            });
            store.commit("setToken", response.data.token);
        } else {
            ElMessage({
                showClose: true,
                message: JSON.stringify(response.data.message),
                type: "error",
            });
        }
    } catch (error) {
        console.log(error);
        ElMessage({
            showClose: true,
            message: "Oops, this is a error message.",
            type: "error",
        });
    }
};

const resetForm = (formEl: FormInstance | undefined) => {
    if (!formEl) return;
    formEl.resetFields();
    ElMessage("Form cleared");
};

const rules = reactive<FormRules<RuleForm>>({
    name: [
        {
            required: true,
            message: "Please input Name",
            trigger: "blur",
        },
        {
            min: 3,
            max: 24,
            message: "Length should be 3 to 24",
            trigger: "blur",
        },
    ],
    email: [
        {
            required: true,
            message: "Please input Email",
            trigger: "blur",
        },
    ],
    password: [
        {
            required: true,
            message: "Please input Password",
            trigger: "blur",
        },
        {
            min: 6,
            max: 24,
            message: "Length should be 6 to 24",
            trigger: "blur",
        },
    ],
    password_confirmation: [
        {
            required: true,
            message: "Please confirm password",
            trigger: "blur",
        },
        {
            validator: password_confirmation,
            message: "Password doesn't match",
            trigger: "blur",
        },
    ],
});
</script>
